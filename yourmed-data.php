<?php
$dir = wp_get_upload_dir();
$cached_file = '/home/admin/web/yourmed24.ru/public_html/wp-content/themes/stomatologiya/yourmed_saved_data.log';
if( !file_exists($cached_file)) file_put_contents( $cached_file, '');

$data        = wp_cache_get( 'yourmed_saved_data' );
if ( ! empty( $data )
     && isset( $data['reviews_list'] )
     && isset( $data['reviews_gallery_list'] )
     && ! empty( $data['clinic_ids'] )
     && ! empty( $data['clinics_list'] )
     && ! empty( $data['doctors_list'] )
     && isset( $data['stomatology_categories'] )
     && isset( $data['licenses'] )
) {
    $data                   = unserialize( file_get_contents( $cached_file ) );
    $reviews_gallery_list   = $data['reviews_gallery_list'];
    $reviews_list           = $data['reviews_list'];
    $clinic_ids             = $data['clinic_ids'];
    $clinics_list           = $data['clinics_list'];
    $doctors_list           = $data['doctors_list'];
    $stomatology_categories = $data['stomatology_categories'];
    $licenses               = $data['licenses'];
} else {
    $wpdb = new wpdb( DB_USER_YOURMED, DB_PASSWORD_YOURMED, DB_NAME_YOURMED, DB_HOST );
    $wpdb->set_prefix( 'wp_' );
    /*
     * Отзывы
     */
    $yourmed_reviews = [
        'post_type'  => 'reviews',
        'paged'      => - 1,
        'meta_query' => [
            [
                'stomatology_clause' => [
                    'key'     => 'stomatology_clinic',
                    'compare' => 'EXISTS'
                ]
            ]
        ]
    ];

    $reviews_list = [];
    $loop         = new WP_Query( $yourmed_reviews );
    while ( $loop->have_posts() ): $loop->the_post();
        $id             = get_the_ID();
        $reviews_list[] = [
            'id'      => $id,
            'title'   => get_the_title(),
            'image'   => get_the_post_thumbnail_url(),
            'stars'   => get_field( 'stars', $id ),
            'content' => get_the_content(),
        ];
    endwhile;
    wp_reset_postdata();

    $reviews_gallery_list = get_field( 'reviews_gallery', 2327 );
    if ( ! empty( $reviews_gallery_list ) ) {
        foreach ( $reviews_gallery_list as $g => $gal ) {
            $reviews_gallery_list[ $g ]['url']                   = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $gal['url'] );
            $reviews_gallery_list[ $g ]['sizes']['medium_large'] = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $gal['sizes']['medium_large'] );
        }
    }

    /*
     * Клиники
     */
    $yourmed_clinics = [
        'post_type'  => 'clinics',
        'paged'      => - 1,
        'meta_query' => [
            [
                'stomatology_clause' => [
                    'key'     => 'stomatology_clinic',
                    'compare' => 'EXISTS'
                ]
            ]
        ]
    ];
    $clinic_ids      = $clinics_list = [];
    $loop            = new WP_Query( $yourmed_clinics );
    while ( $loop->have_posts() ): $loop->the_post();
        $id = get_the_ID();
        if ( get_field( 'stomatology_clinic', $id ) ) {
            $post         = get_post( $id );
            $clinic_ids[] = $id;

            $gallery_data = get_field( 'gallery', $id );
            if ( ! empty( $gallery_data ) ) {
                $gallery = [];
                foreach ( $gallery_data as $g => $gal ) {
                    if ( ! empty( $gal['url'] ) ) {
                        $ff                   = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $gal['url'] );
                        $gallery[ $g ]['url'] = $ff;
                    }
                }
            }
            $gallery_stomatology = get_field( 'gallery_stomatology', $id );
            if ( ! empty( $gallery_stomatology ) ) {
                foreach ( $gallery_stomatology as $g => $gal ) {
                    $gallery_stomatology[ $g ]['url'] = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $gal['url'] );
                }
            }
            $gallery_phones_data = get_field( 'phones', $id );
            if ( ! empty( $gallery_phones_data ) ) {
                $gallery_phones = [];
                foreach ( $gallery_phones_data as $g => $gal ) {
                    $gallery_phones[] = $gal['telefon'];
                }
            }
            $clinics_list[] = [
                'id'                  => $id,
                'title'               => get_the_title(),
                'slug'                => $post->post_name,
                'yandex'              => get_field( 'yandex', $id ),
                'address'             => get_field( 'address', $id ),
                'map_link'            => get_field( 'map_link', $id ),
                'schedule'            => get_field( 'schedule', $id ),
                'email'               => get_field( 'email', $id ),
                'lat'                 => get_field( 'lat', $id ),
                'lng'                 => get_field( 'lng', $id ),
                'phones'              => $gallery_phones,
                'gallery'             => $gallery ?? [],
                'gallery_stomatology' => $gallery_stomatology,
                'gallery_route'       => get_field( 'gallery_route', $id ),
                'stomatology_clinic'  => get_field( 'stomatology_clinic', $id ),
            ];
        }
    endwhile;
    wp_reset_postdata();
    /*
     * Доктора
     */
    $yourmed_doctors = [
        'post_type'      => 'doctors',
        'posts_per_page' => - 1,
        'meta_query'     => [
            [
                'service_clause' => [
                    'key'     => 'services',
                    'value'   => '1225',
                    'compare' => 'LIKE'
                ]
            ],
            [
                'position_clause' => [
                    'key'     => 'position_stomatology',
                    'compare' => 'EXISTS'
                ]
            ]
        ],
        'orderby'        => [
            'position_clause' => 'DESC',
            'post_title'      => 'ASC',
        ]
    ];
    $doctors_list    = [];
    $loop            = new WP_Query( $yourmed_doctors );
    while ( $loop->have_posts() ): $loop->the_post();
        $id             = get_the_ID();
        $post_thumbnail = ! empty( get_the_post_thumbnail_url( $id, 'doctors-img' ) ) ? get_the_post_thumbnail_url( $id, 'doctors-img' ) : ( get_field( 'pol', $id ) == 'м' ? '/wp-content/uploads/images/_no-photo-male-min.png' : '/wp-content/uploads/images/_no-photo-female-min.png' );
        $post_thumbnail = preg_replace( '#^https?\:\/\/(stom\.(int|ru)|yourmed24\.ru){1,}#msiU', '', $post_thumbnail );
        $post           = get_post( $id );
        $clinics        = [];
        foreach ( get_field( 'clinics', $id ) as $clinic ) {
            $clinics[] = [
                'id'    => $clinic->ID,
                'value' => $clinic->post_name,
                'title' => $clinic->post_title,
            ];
        }
        $reviews_gallery = get_field( 'reviews_gallery', $id );
        if ( ! empty( $reviews_gallery ) ) {
            foreach ( $reviews_gallery as $g => $gal ) {
                $reviews_gallery[ $g ]['url'] = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $gal['url'] );
            }
        }
        $works_stomatology = [];
        if ( have_rows( 'works_stomatology', $id ) ) {
            while ( have_rows( 'works_stomatology', $id ) ): the_row();
                $works_stomatology[] = [
                    'title'      => get_sub_field( 'title' ),
                    'text'       => get_sub_field( 'text' ),
                    'img_before' => ! empty( get_sub_field( 'img_before' )['url'] ) ? preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', get_sub_field( 'img_before' )['url'] ) : false,
                    'img_after'  => ! empty( get_sub_field( 'img_after' )['url'] ) ? preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', get_sub_field( 'img_after' )['url'] ) : false,
                ];
            endwhile;
        }
        $v_b            = get_field( 'video_vizitka' );
        $doctors_list[] = [
            'id'                      => $id,
            'title'                   => get_the_title(),
            'image'                   => $post_thumbnail,
            'check111'                => 'true11asd as dasd as',
            'bio'                     => ! empty( $v_b[0]['code'] ) ? $v_b[0]['code'] : '',
            'check222'                => '6546tfyb9ij0k09kopasd',
            'job'                     => get_field( 'должность', $id ),
            'experience'              => get_field( 'стаж', $id ),
            'content'                 => get_the_content(),
            'permalink'               => '/doctors/' . $post->post_name . '/',
            'post_name'               => $post->post_name,
            'categories'              => get_field( 'stomatology_categories', $id ),
            'clinics'                 => $clinics,
            'общее_описание'          => get_field( 'общее_описание' ),
            'cost'                    => get_field( 'первичный_прием', $id ),
            'aged'                    => get_field( 'aged', $id ),
            'obrazovanie'             => get_field( 'obrazovanie', $id ),
            'internatura_ordinatura'  => get_field( 'internatura_ordinatura', $id ),
            'kursy'                   => get_field( 'kursy', $id ),
            'dostizheniya'            => get_field( 'dostizheniya', $id ),
            'opyt_raboty'             => get_field( 'opyt_raboty', $id ),
            'science'                 => get_field( 'science', $id ),
            'video'                   => get_field( 'video', $id ),
            'v_b'                     => ! empty( $v_b[0]['code'] ) ? getVideoLink($v_b[0]['code']) : '',
            'профессиональные_навыки' => get_field( 'профессиональные_навыки', $id ),
            'show_video_reviews'      => get_field( 'show_video_reviews', $id ),
            'certificates'            => get_field( 'certificates', $id ),
            'works'                   => get_field( 'works', $id ),
            'works_stomatology'       => $works_stomatology,
            'expanded'                => get_field( 'expanded', $id ),
            'reviews_gallery'         => $reviews_gallery,
        ];
    endwhile;
    wp_reset_postdata();

    /*
     * Категории
     */
    $stomatology_categories_field = get_field_object( 'field_647d87be91ef0' );
    $stomatology_categories       = $stomatology_categories_field['choices'] ?? [];

    /*
     * Лицензии
     */
    $license  = get_post_by_field( 'post_name', 'licenses', 'page' );
    $licenses = get_field( 'list', $license->ID );
    if ( ! empty( $licenses ) ) {
        foreach ( $licenses as $l => $license ) {
            $licenses[ $l ]['pdf']['url']               = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $license['pdf']['url'] );
            $licenses[ $l ]['image']['sizes']['medium'] = preg_replace( '#yourmed24\.ru|stom\.int#', 'yourmed.clinic', $license['image']['sizes']['medium'] );
        }
    }

    wp_cache_flush();
    $key  = 'yourmed_saved_data';
    $data = [
        'reviews_list'           => $reviews_list,
        'clinic_ids'             => $clinic_ids,
        'clinics_list'           => $clinics_list,
        'doctors_list'           => $doctors_list,
        'stomatology_categories' => $stomatology_categories,
        'licenses'               => $licenses,
        'reviews_gallery_list'   => $reviews_gallery_list,
    ];
    define( 'WP_REDIS_DEFAULT_MAXTTL', 60 * 60 * 24 * 30 );
    wp_cache_add( $key, $data, '', WP_REDIS_DEFAULT_MAXTTL );
    wp_cache_replace( $key, $data, '', WP_REDIS_DEFAULT_MAXTTL );
    wp_cache_set( $key, $data, '', WP_REDIS_DEFAULT_MAXTTL );
    if ( $f = fopen( $cached_file, "w" ) ) {
        fwrite( $f, serialize( $data ) );
        fclose( $f );
    }


    $wpdb = new wpdb( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );
    $wpdb->set_prefix( 'wp_' );
}
