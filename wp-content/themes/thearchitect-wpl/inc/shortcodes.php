<?php
/**
 * Define Shortcodes
 */

// [row]
if (!function_exists('shortcode_row')) {
    function shortcode_row($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'bg_color' => '',
            'bg_image' => '',
            'bg_repeat' => 'no-repeat',
            'bg_size' => '',
            'text_color' => '',
            'text_align' => '',
            'padding' => '',
            'wrap' => 'false',
            'parallax' => 'false',
            'height' => ''
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($bg_image != "") {
            $style .= "background: url('".$bg_image."') ".$bg_repeat." 0 0;";
        }

        if($bg_color != "") {
            $style .= "background-color: ".$bg_color.";";
        }

        if($bg_size != "") {
            $style .= "background-size: ".$bg_size.";";
        }

        if($height != "") {
            $style .= "height: ".$height.";";
        }

        if($text_color != "") {
            $style .= "color: ".$text_color.";";
        }

        if($text_align != "") {
            $style .= "text-align: ".$text_align.";";
        }

        if($padding != "") {
            $style .= "padding: ".$padding.";";
        }

        if($parallax != "false") {
            $html .= '<div class="row parallax cf" style="' .$style. '" data-start="background-position:0px 0px;" data-end="background-position:0 -' .$height. '">';
        } else {
            $html .= '<div class="row cf" style="' .$style. '">';
        }
            if($wrap != "false") {
                $html .= '<div class="wrap" style="' .$style. '">';
            }
            $html .= ' '.$content.' ';
            if($wrap != "false") {
                $html .= '</div>';
            }
        $html .= '</div>';

        return $html;
    }
}

// [one_half]
if (!function_exists('shortcode_grid_one_half')) {
    function shortcode_grid_one_half($params = array(), $content = null) {
        extract(shortcode_atts(array(
           'bg_color' => '',
           'padding' => '',
           'last' => '',
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($bg_color != "") {
            $style .= "background-color: ".$bg_color.";";
        }

        if($padding != "") {
            $style .= "padding: ".$padding.";";
        }

        if ( $last == 'true' ) {
            $html .= '<div class="one_half last" style="' .$style. '">';
            $html .= ' '.$content.' ';
            $html .= '</div><div class="cf"></div>';
        } else {
            $html .= '<div class="one_half" style="' .$style. '">';
            $html .= ' '.$content.' ';
            $html .= '</div>';
        }

        return $html;
    }
}

// [one_third]
if (!function_exists('shortcode_grid_one_third')) {
    function shortcode_grid_one_third($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'bg_color' => '',
            'padding' => '',
            'last' => ''
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($bg_color != "") {
            $style .= "background-color: ".$bg_color.";";
        }

        if($padding != "") {
            $style .= "padding: ".$padding.";";
        }

        if ( $last == 'true' ) {
            $html .= '<div class="one_third last" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
        } else {
            $html .= '<div class="one_third" style="' .$style. '">'.$content.'</div>';
        }

        return $html;
    }
}

// [two_third]
if (!function_exists('shortcode_grid_two_third')) {
    function shortcode_grid_two_third($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'bg_color' => '',
            'padding' => '',
            'last' => '',
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($bg_color != "") {
            $style .= "background-color: ".$bg_color.";";
        }

        if($padding != "") {
            $style .= "padding: ".$padding.";";
        }

        if ( $last == 'true' ) {
            $html .= '<div class="two_third last" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
        } else {
            $html .= '<div class="two_third" style="' .$style. '">'.$content.'</div>';
        }

       return $html;
    }
}

// [one_fourth]
if (!function_exists('shortcode_grid_one_fourth')) {
    function shortcode_grid_one_fourth($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'bg_color' => '',
            'padding' => '',
            'last' => '',
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($bg_color != "") {
            $style .= "background-color: ".$bg_color.";";
        }

        if($padding != "") {
            $style .= "padding: ".$padding.";";
        }

        if ( $last == 'true' ) {
            $html .= '<div class="one_fourth last" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
        } else {
            $html .= '<div class="one_fourth" style="' .$style. '">'.$content.'</div>';
        }

        return $html;
    }
}

// [three_fourth]
if (!function_exists('shortcode_grid_three_fourth')) {
    function shortcode_grid_three_fourth($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'bg_color' => '',
            'padding' => '',
            'last' => '',
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($bg_color != "") {
            $style .= "background-color: ".$bg_color.";";
        }

        if($padding != "") {
            $style .= "padding: ".$padding.";";
        }

        if ( $last == 'true' ) {
            $html .= '<div class="three_fourth last" style="' .$style. '">'.$content.'</div><div class="cf"></div>';
        } else {
            $html .= '<div class="three_fourth" style="' .$style. '">'.$content.'</div>';
        }

        return $html;
    }
}

// [heading_block]
if (!function_exists('shortcode_heading_block')) {
    function shortcode_heading_block($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'bg_color' => '',
            'bg_image' => '',
            'text_align' => '',
            'text_color' => '',
            'text_size' => '',
            'font_weight' => ''
        ), $params));

        // init variables
        $html = '';
        $headingstyle = '';
        $divstyle = '';
        $content = do_shortcode($content);

        if($bg_color != "") {
            $divstyle .= 'background: '.$bg_color.';';
        }

        if($bg_image != "") {
            $divstyle .= 'background: '.$bg_color.' url('.$bg_image.');';
        }

        if($text_align != "") {
            $divstyle .= 'text-align: '.$text_align.';';
        }

        if($text_color != "") {
            $headingstyle .= 'color: '.$text_color.';';
        }

        if($text_size != "") {
            $headingstyle .= 'font-size: '.$text_size.';';
        }

        if($font_weight != "") {
            $headingstyle .= 'font-weight: '.$font_weight.';';
        }

        $html .= '<div class="shortcode_heading_block" style="'.$divstyle. '">';
        $html .= '<h1 style="'.$headingstyle. '">'.$content.'</h1>';
        $html .= '</div>';

        return $html;
    }
}

// [text_block]
if (!function_exists('shortcode_text_block')) {
    function shortcode_text_block($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'title_tag' => 'h1',
            'title' => 'Title',
            'title_color' => '#1c1c1e',
            'bg_color' => '#fff',
            'bg_image' => '',
            'text_color' => '#9c9d9f',
            'sep_padding' => '5px',
            'sep_color' => '#1c1c1e',
            'padding_top' => '',
            'padding_bottom' => ''
        ), $params));

        $headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        // init variables
        $html               = "";
        $style              = "";
        $style_title        = "";
        $content = do_shortcode($content);

        if($title_color != "") {
            $style_title .= 'color: '.$title_color.';';
        }

        if($bg_color != "") {
            $style .= 'background: '.$bg_color.';';
        }

        if($bg_image != "") {
            $style .= 'background-image: url('.$bg_image.');';
        }

        if($padding_top != "") {
            $style .= 'padding-top: '.$padding_top.';';
        }

        if($padding_bottom != "") {
            $style .= 'padding-bottom: '.$padding_bottom.';';
        }

        $html .= '<div class="shortcode_text_block" style="'.$style.'">';
            $html .= '<'.$title_tag.' class="title" style="'.$style_title.'">'.$title.'</'.$title_tag.'>';
            $html .= '<div class="text_block_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>';
            $html .= '<p style="color:'.$text_color.'">'.$content.'</p>';
        $html .= '</div>';

        return $html;
    }
}

// [button]
if (!function_exists('shortcode_button')) {
    function shortcode_button($atts, $content = null) {
        $args = array(
            "size"                      => "",
            "color"                     => "",
            "text"                      => "",
            "text_color"                => "",
            "icon"                      => "",
            "icon_color"                => "",
            "link"                      => "",
            "target"                    => "_self",
            "font_style"                => "",
            "font_weight"               => "",
            "align"                     => "",
            "margin"                    => ""
        );
        extract(shortcode_atts($args, $atts));

        if($target == ""){
            $target = "_self";
        }

        //init variables
        $html  = "";
        $button_classes = "btn ";
        $button_styles  = "";
        $add_icon       = "";

        if($size != "") {
            $button_classes .= " {$size}";
        }

        if($align != "") {
            $button_classes .= " {$align}";
        }

        if($color != "") {
            $button_classes .= " {$color}";
        }

        if($text_color != ""){
            $button_styles .= 'color: '.$text_color.'; ';
        }

        if($font_style != ""){
            $button_styles .= 'font-style: '.$font_style.'; ';
        }

        if($font_weight != ""){
            $button_styles .= 'font-weight: '.$font_weight.'; ';
        }

        if($icon != ""){
            $icon_style = "";
            if($icon_color != ""){
                $icon_style .= 'color: '.$icon_color.';';
            }
            $add_icon .= '<i class="fa fa-fx '.$icon.'" style="'.$icon_style.'"></i>';
        }

        if($margin != ""){
            $button_styles .= 'margin: '.$margin.'; ';
        }

        $html .=  '<a href="'.$link.'" target="'.$target.'" class="'.$button_classes.'" style="'.$button_styles.'">'.$text.$add_icon.'</a>';
        return $html;
    }
}

// [list]
if(!function_exists('shortcode_list')) {
    function shortcode_list($atts, $content = null) {
        $default_atts = array(
            "type"          => "plain",
        );

        extract(shortcode_atts($default_atts, $atts));

        // init variables
        $html = "";
        $content = do_shortcode($content);

        $html .= '<ul class="' .$type. '">';
        $html .= ''.$content.'';
        $html .= '</ul>';

        return $html;
    }
}

// [list_images]
if(!function_exists('shortcode_list_images')) {
    function shortcode_list_images($atts, $content = null) {
        $default_atts = array(
            "columns"          => "four",
        );

        extract(shortcode_atts($default_atts, $atts));

        // init variables
        $html = "";
        $content = do_shortcode($content);

        $html .= '<div class="shortcode_list_images" style="padding-bottom:25px">';
        $html .= '<ul class="'.$columns.'_col">';
        $html .= ''.$content.'';
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}

// [icon_text]
if(!function_exists('shortcode_icon_text')) {
    function shortcode_icon_text($atts, $content = null) {
        $default_atts = array(
            "icon_size"             => "",
            "set_custom_icon_size"  => "",
            "custom_icon_size"      => "",
            "custom_icon_margin"    => "",
            "icon"                  => "",
            "image"                 => "",
            "icon_type"             => "",
            "icon_position"         => "",
            "icon_border_color"     => "",
            "icon_margin"           => "",
            "icon_color"            => "",
            "icon_background_color" => "",
            "title"                 => "",
            "title_tag"             => "h5",
            "title_color"           => "",
            "text"                  => "",
            "text_color"            => "",
            "link"                  => "",
            "link_text"             => "",
            "link_color"            => "",
            "target"                => ""
        );

        extract(shortcode_atts($default_atts, $atts));

        //get correct heading value. If provided heading isn't valid get the default one
        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        //init icon styles
        $style = '';
        $icon_stack_classes = '';

        //init icon stack styles
        $icon_margin_style       = '';
        $icon_stack_square_style = '';
        $icon_stack_base_style   = '';
        $icon_stack_style        = '';
        $img_styles              = '';
        $icon_text_holder_styles = '';

        //generate inline icon styles
        if($set_custom_icon_size == "true") {
            if($custom_icon_size != "") {
                //remove px if user has entered it
                $custom_icon_size = strstr($custom_icon_size, 'px', true) ? strstr($custom_icon_size, 'px', true) : $custom_icon_size;
                $icon_stack_style .= 'font-size: '.$custom_icon_size.'px;';
            }

            if($custom_icon_margin != "") {
                //remove px if user has entered it
                $custom_icon_margin = strstr($custom_icon_margin, 'px', true) ? strstr($custom_icon_margin, 'px', true) : $custom_icon_margin;
                $custom_icon_margin = $custom_icon_size + $custom_icon_margin;
                $icon_text_holder_styles .= 'padding-left:'.$custom_icon_margin.'px;';
            }

        }

        if($icon_color != "") {
            $style .= 'color: '.$icon_color.';';
        }

        //generate icon stack styles
        if($icon_background_color != "") {
            $icon_stack_base_style .= 'background-color: '.$icon_background_color.';';
            $icon_stack_square_style .= 'background-color: '.$icon_background_color.';';
        }

        if($icon_border_color != "") {
            $icon_stack_style .= 'border-color: '.$icon_border_color.';';
        }

        if($icon_margin != "") {
            $icon_margin_style .= "margin: ".$icon_margin.";";
            $img_styles       .= "margin: ".$icon_margin.";";
        }

        $box_size = '';
        //generate icon text holder styles and classes

        //map value of the field to the actual class value
        switch ($icon_size) {
            case 'tiny': //smallest icon size
                $box_size = 'tiny';
                break;
            case 'fa-2x':
                $box_size = 'small';
                break;
            case 'fa-3x':
                $box_size = 'medium';
                break;
            case 'fa-4x':
                $box_size = 'large';
                break;
            case 'fa-5x':
                $box_size = 'very_large';
                break;
            default:
                $box_size = 'small';
        }

        if($image != "") {
            $icon_type = 'image';
        }

        $box_icon_type = '';
        switch ($icon_type) {
            case 'normal':
                $box_icon_type = 'normal_icon';
                break;
            case 'square':
                $box_icon_type = 'square';
                break;
            case 'circle':
                $box_icon_type = 'circle';
                break;
        }

        /* Generate text styles */
        $title_style = "";

        if($title_color != "") {
            $title_style .= "color: ".$title_color;
        }

        $text_style = "";
        if($text_color != "") {
            $text_style .= "color: ".$text_color;
        }

        $link_style = "";

        if($link_color != "") {
            $link_style .= "color: ".$link_color.";";
        }

        $html = "";
        $html_icon = "";

        if($image == "") {
            //genererate icon html
            switch ($icon_type) {
                case 'circle':
                    $html_icon .= '<span class="fa-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style . $icon_stack_base_style .'">';
                   // $html_icon .= '<i class="fa fa-circle fa-stack-base fa-stack-2x" style="'.$icon_stack_base_style.'"></i>';
                    $html_icon .= '<i class="fa '.$icon.' fa-stack-1x" style="'.$style. '"></i>';
                    $html_icon .= '</span>';
                    break;
                case 'square':
                    $html_icon .= '<span class="fa-stack '.$icon_size.' '.$icon_stack_classes.'" style="'.$icon_stack_style.$icon_stack_square_style.'">';
                    $html_icon .= '<i class="fa '.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
                default:
                    $html_icon .= '<span style="'.$icon_stack_style.'" class="fa_icon '.$icon_size.' '.$icon_stack_classes.'">';
                    $html_icon .= '<i class="fa '.$icon.'" style="'.$style.'"></i>';
                    $html_icon .= '</span>';
                    break;
            }
        } else {
            if(is_numeric($image)) {
                $image_src = wp_get_attachment_url( $image );
            }else {
                $image_src = $image;
            }
            $html_icon = '<img style="'.$img_styles.'" src="'.$image_src.'" alt="">';
        }

        //init icon text wrapper styles
        $icon_with_text_clasess = '';
        $icon_with_text_style   = '';
        $icon_text_inner_style = '';

        $icon_with_text_clasess .= $box_size;
        $icon_with_text_clasess .= ' '.$box_icon_type;

        if($icon_position == "" || $icon_position == "top") {
            $icon_with_text_clasess .= " center";
        }
        if($icon_position == "left_from_title"){
             $icon_with_text_clasess .= " left_from_title";
        }
        $html .= "<div class='shortcode_icon_with_title ".$icon_with_text_clasess."'>";
        if($icon_position != "left_from_title") {
            //generate icon holder html part with icon
            $html .= '<div class="icon_holder" style="'.$icon_margin_style.' ">';
            $html .= $html_icon;
            $html .= '</div>'; //close icon_holder
        }
        //generate text html
        $html .= '<div class="icon_text_holder" style="'.$icon_text_holder_styles.'">';
        $html .= '<div class="icon_text_inner" style="'.$icon_text_inner_style.'">';
         if($icon_position == "left_from_title") {
            $html .= '<div class="icon_title_holder">'; //generate icon_title holder for icon from title
            //generate icon holder html part with icon
            $html .= '<div class="icon_holder" style="'.$icon_margin_style.' ">';
            $html .= $html_icon;
            $html .= '</div>'; //close icon_holder
        }
        $html .= '<'.$title_tag.' class="icon_title" style="'.$title_style.'">'.$title.'</'.$title_tag.'>';
         if($icon_position == "left_from_title") {
            $html .= '</div>'; //close icon_title holder for icon from title
         }
        $html .= "<p style='".$text_style."'>".$text."</p>";
        if($link != ""){
            if($target == ""){
                $target = "_self";
            }

            if($link_text == ""){
                $link_text = "Read More";
            }

            $html .= "<a class='icon_with_title_link' href='".$link."' target='".$target."' style='".$link_style."'>".$link_text."</a>";
        }
        $html .= '</div>';  //close icon_text_inner
        $html .= '</div>'; //close icon_text_holder

        $html .= '</div>'; //close icon_with_title

        return $html;

    }
}

// [team]
if (!function_exists('shortcode_team')) {
    function shortcode_team($atts, $content = null) {
        $args = array(
            "title_tag"            => "h3",
            "style"                => "square",
            "size"                 => "normal",
            "image"                => "",
            "name"                 => "",
            "position"             => "",
            "description"          => "",
            "social_icon_1"        => "",
            "social_icon_1_link"   => "",
            "social_icon_1_target" => "",
            "social_icon_2"        => "",
            "social_icon_2_link"   => "",
            "social_icon_2_target" => "",
            "social_icon_3"        => "",
            "social_icon_3_link"   => "",
            "social_icon_3_target" => "",
            "social_icon_4"        => "",
            "social_icon_4_link"   => "",
            "social_icon_4_target" => "",
            "social_icon_5"        => "",
            "social_icon_5_link"   => "",
            "social_icon_5_target" => ""
        );

        extract(shortcode_atts($args, $atts));
        $headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        if(is_numeric($image)) {
            $team_image_src = wp_get_attachment_url( $image );
        } else {
            $team_image_src = $image;
        }

        //html output
        $html =  "<div class='shortcode_team'>";

            $html .=  "<div class='team_inner $size'>";

                if($image != "") {
                    $html .=  "<div class='team_image'>";
                        $html .= "<img src='$team_image_src' alt='$name' class='$style' />";
                    $html .=  "</div>";
                }

                $html .=  "<div class='team_text'>";

                    $html .=  "<div class='team_text_inner'>";

                        $html .=  "<div class='team_title_holder'>";
                            $html .=  "<$title_tag class='team_name'>";
                                $html .= $name;
                            $html .=  "</$title_tag>";
                            if($position != "") {
                                $html .= "<span>" . $position . "</span>";
                            }
                        $html .=  "</div>";

                    $html .=  "</div>";

                $html .=  "</div>";

                if($description != "") {

                    $html .= "<span class='line small gray center'></span>";

                    $html .= "<div class='team_description'>";

                        $html .= "<p>".$description."</p>";

                        $html .=  "<div class='team_social_holder'>";
                        if($social_icon_1 != "") {
                            $html .=  do_shortcode('[social_icons type="normal_social" icon="'. $social_icon_1 .'" size="fa-2x" link="' . $social_icon_1_link . '" target="' . $social_icon_1_target . '"]');
                        }
                        if($social_icon_2 != "") {
                            $html .=  do_shortcode('[social_icons type="normal_social" icon="'. $social_icon_2 .'" size="fa-2x" link="' . $social_icon_2_link . '" target="' . $social_icon_2_target . '"]');
                        }
                        if($social_icon_3 != "") {
                            $html .=  do_shortcode('[social_icons type="normal_social" icon="'. $social_icon_3 .'" size="fa-2x" link="' . $social_icon_3_link . '" target="' . $social_icon_3_target . '"]');
                        }
                        if($social_icon_4 != "") {
                            $html .=  do_shortcode('[social_icons type="normal_social" icon="'. $social_icon_4 .'" size="fa-2x" link="' . $social_icon_4_link . '" target="' . $social_icon_4_target . '"]');
                        }
                        if($social_icon_5 != "") {
                            $html .=  do_shortcode('[social_icons type="normal_social" icon="'. $social_icon_5 .'" size="fa-2x" link="' . $social_icon_5_link . '" target="' . $social_icon_5_target . '"]');
                        }
                        $html .=  "</div>";

                    $html .=  "</div>";
                }

            $html .=  "</div>";

        $html .=  "</div>";

        return $html;
    }
}

// [social_icons]
if (!function_exists('shortcode_social_icons')) {
    function shortcode_social_icons($atts, $content = null) {
        $args = array(
            "type"                              => "",
            "icon"                              => "",
            "link"                              => "",
            "target"                            => "",
            "use_custom_size"                   => "",
            "custom_size"                       => "",
            "size"                              => "",
            "icon_color"                        => "",
            "icon_hover_color"                  => "",
            "background_color"                  => "",
            "background_hover_color"            => "",
            "background_color_transparency"     => "",
            "border_width"                      => "",
            "border_color"                      => "",
            "border_hover_color"                => "",
            "icon_margin"                       => ""
        );

        extract(shortcode_atts($args, $atts));

        $html               = "";
        $fa_stack_styles    = "";
        $icon_styles        = "";
        $data_attr          = "";

        if($background_color != ""){
            if(!empty($background_color_transparency) && ($background_color_transparency >= 0 && $background_color_transparency <= 1)) {
                $rgb = qode_hex2rgb($background_color);

                $background_color = 'rgba('.$rgb[0].', '.$rgb[1].', '.$rgb[2].', '.$background_color_transparency.')';
            }

            $fa_stack_styles .= "background-color: {$background_color};";
           }

        if($border_color != "") {
            $fa_stack_styles .= "border-color: ".$border_color.";";
        }

        if($border_width != "") {
            $fa_stack_styles .= "border-width: ".$border_width."px;";
        }

        if($icon_color != ""){
            $icon_styles .= "color: ".$icon_color.";";
        }

        if($icon_margin != "") {
            $icon_styles .= "margin: ".$icon_margin;
        }

        if($background_hover_color != "") {
            $data_attr .= "data-hover-background-color=".$background_hover_color." ";
        }

        if($border_hover_color != "") {
            $data_attr .= "data-hover-border-color=".$border_hover_color." ";
        }

        if($icon_hover_color != "") {
            $data_attr .= "data-hover-color=".$icon_hover_color;
        }

        if($use_custom_size == 'yes' && $custom_size != '') {
            $icon_styles .= 'font-size: '.$custom_size."px;";
            $fa_stack_styles .= 'font-size: '.$custom_size."px;";
        }

        $html .= "<span class='shortcode_social_icon_holder $type' $data_attr>";

        if($link != ""){
            $html .= "<a href='".$link."' target='".$target."'>";
        }

            if($type == "normal_social"){
                $html .= "<i class='fa ".$icon." ".$size." simple_social' style='".$icon_styles."'></i>";
            } else {
                $html .= "<span class='fa-stack ".$size."' style='".$fa_stack_styles."'>";
                $html .= "<i class='fa ".$icon."' style='".$icon_styles."'></i>";
                $html .= "</span>"; //close fa-stack
            }

        if($link != ""){
            $html .= "</a>";
        }

        $html .= "</span>";
        return $html;
    }
}

// [service_table]
if (!function_exists('shortcode_service_table')) {
    function shortcode_service_table($atts, $content = null) {
        global $sbwp_options;
        $args = array(
            "title"                    => "",
            "title_tag"                => "h5",
            "title_color"              => "",
            "icon"                     => "",
            "icon_size"                => "",
            "icon_color"               => "",
            "icon_custom_size"         => "",
            "bg_color"                 => "",
            "border_color"             => "",
            "border_size"              => "1px"
        );

        extract(shortcode_atts($args, $atts));

        //get correct heading value. If provided heading isn't valid get the default one
        $headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        //init variables
        $html = "";
        $title_holder_style = "";
        $title_style = "";
        $title_classes = "";
        $icon_style = "";
        $content_style = "";
        $holder_style = "";
        $content = do_shortcode($content);

        if($title_color != ""){
            $title_style .= "color: ".$title_color.";";
            $title_holder_style .= "color: ".$title_color.";";
        }

        if($icon_custom_size != ""){
            $icon_style .= "font-size: ".$icon_custom_size.";";
        }

        if($icon_color != ""){
            $icon_style .= "color: ".$icon_color.";";
        }

        if($bg_color != ""){
            $content_style .= "background-color: ".$bg_color.";";
        }

        if($border_color != ""){
            $holder_style .= "border: ".$border_size." solid ".$border_color.";";
        }

        $html .= "<div class='shortcode_service_table_holder' style='".$content_style." ".$holder_style."'><ul class='shortcode_service_table_inner'>";

        $html .= "<li class='title_holder ".$title_classes."' style='".$title_holder_style."'>";

        $html .= "<div class='title_inner'><div class='title_inner'>";

        if($title != ""){
            $html .= "<".$title_tag." class='service_title' style='".$title_style."'>".$title."</".$title_tag.">";
        }

        if($icon != ""){
            $html .= "<i class='fa ".$icon." ".$icon_size."' style='".$icon_style."'></i>";
        }

        $html .= "</div></div>";

        $html .= "</li>";

        $html .= "<li class='service_table_content' style='".$content_style."'>";

        $html .= $content;

        $html .= "</li>";

        $html .= "</ul></div>";

        return $html;
    }
}

// [pricing_table]
if (!function_exists('shortcode_pricing_table')) {
    function shortcode_pricing_table($atts, $content = null) {
        $args = array(
            "title"             => "Basic",
            "title_tag"         => "h4",
            "title_size"        => "32px",
            "title_color"       => "#1c1c1e",
            "price_color"       => "#1c1c1e",
            "text_color"        => "",
            "sep_color"         => "#bb3e3e",
            "subtitle"          => "Package",
            "price"             => "100",
            "currency"          => "$",
            "price_period"      => "/mo",
            "active"            => "",
            "active_text"       => "BEST OFFER",
            "bg_color"          => ""
        );

        extract(shortcode_atts($args, $atts));

        //get correct heading value. If provided heading isn't valid get the default one
        $headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        // init variables
        $html           = "";
        $box_style      = "";
        $title_style    = "";
        $price_style    = "";
        $text_style     = "";
        $sep_style      = "";

        if($bg_color != ""){
            $box_style = "style='background-color: ".$bg_color.";'";
        }

        if($title_size != ""){
            $title_style = "font-size: ".$title_size.";color: ".$title_color.";";
        }

        if($text_color != ""){
            $text_style = "style='color: ".$text_color.";'";
        }

        if($price_color != ""){
            $price_style = "style='color: ".$price_color.";'";
        }

        if($sep_color != ""){
            $sep_style = "style='border-top: 2px solid ".$sep_color.";'";
        }

        if($active == "yes"){
            $html .= "<div class='shortcode_price_table active_price'>";
        } else {
            $html .= "<div class='shortcode_price_table'>";
        }

        if($active == "yes"){
            $html .= "<div class='active_price_table'><h5>".$active_text."</h5></div>";
        }

        $html .= "<div class='price_table_inner' ".$box_style.">";
        $html .= "<ul>";
        $html .= "<li class='prices'>";
        $html .= "<".$title_tag." class='title' style='".$title_style."'>".$title."</".$title_tag.">";
        $html .= "<span class='subtitle' ".$text_style.">".$subtitle."</span>";
        $html .= "<span class='price_in_table' ".$price_style.">";
        $html .= "<sup class='value'>".$currency."</sup>";
        $html .= "<span class='price'>".$price."</span>";
        $html .= "<span class='mark'>".$price_period."</span>";
        $html .= "</span>";
        $html .= "<span class='line center' ".$sep_style."></span>";
        $html .= "</li>";

        $html .= "<li class='pricing_table_content' ".$text_style.">";
        $html .= do_shortcode($content);
        $html .= "</li>";

        $html .= "</ul>";
        $html .= "</div>";
        $html .="</div>";

        return $html;
    }
}

// [pricing_tables]
if (!function_exists('shortcode_pricing_tables')) {
    function shortcode_pricing_tables($atts, $content = null) {
        $args = array(
            "columns"     => "three"
        );
        extract(shortcode_atts($args, $atts));

        // init variables
        $html = "";

        $html .= "<div class='shortcode_price_table_holder ".$columns."_columns'>";
        $html .= do_shortcode($content);
        $html .= '</div>';

        return $html;
    }
}

// [spacer]
if (!function_exists('shortcode_spacer')) {
    function shortcode_spacer($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'top' => '0px',
            'bottom' => '0px'
        ), $params));

        // init variables
        $html = '';

        $html .= '<div class="clear cf" style="margin-top:'.$top.';margin-bottom:'.$bottom.'"></div>';
        return $html;
    }
}

// [text_columns]
if (!function_exists('shortcode_text_columns')) {
    function shortcode_text_columns($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'col' => '2'
        ), $params));

        // init variables
        $html = '';
        $class = '';
        $content = do_shortcode($content);

        if($col == "2"){
            $class .= "two-cols";
        } elseif($col == "3") {
            $class .= "three-cols";
        } elseif($col == "4") {
            $class .= "four-cols";
        } else {
            $class .= "two-cols";
        }

        $html .= '<div class="shortcode_text_columns ' .$class. '">'.$content.'</div>';
        return $html;
    }
}

// [lead]
if (!function_exists('shortcode_lead')) {
    function shortcode_lead($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'text_color' => ''
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($text_color != ""){
            $style = "style='color: ".$text_color.";'";
        }

        $html .= '<p class="lead" '.$style.'>'.$content.'</p>';
        return $html;
    }
}

// [highlight]
if (!function_exists('shortcode_highlight')) {
    function shortcode_highlight($params = array(), $content = null) {

        // init variables
        $html = '';
        $content = do_shortcode($content);

        $html .= '<span class="shortcode_highlight">'.$content.'</span>';
        return $html;
    }
}

// [code]
if (!function_exists('shortcode_code')) {
    function shortcode_code($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'source' => 'plain'
        ), $params));

        // init variables
        $html = '';
        $content = preg_replace('#<br\s*/?>#', "", $content);

        $html .= '<pre class="brush: '.$source.';">'.$content.'</pre>';
        return $html;
    }
}

// [divider]
if (!function_exists('shortcode_divider')) {
    function shortcode_divider($params = array(), $content = null) {

        // init variables
        $html = '';
        $content = do_shortcode($content);

        $html .= '<div class="shortcode_divider"><h3>'.$content.'</h3></div>';
        return $html;
    }
}

// [padding]
if (!function_exists('shortcode_padding')) {
    function shortcode_padding($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'top' => '8%',
            'bottom' => '8%',
            'left' => '8%',
            'right' => '8%'
        ), $params));

        // init variables
        $html = '';
        $style = '';
        $content = do_shortcode($content);

        if($top != "") {
            $style .= "padding-top: ".$top.";";
        }

        if($bottom != "") {
            $style .= "padding-bottom: ".$bottom.";";
        }

        if($left != "") {
            $style .= "padding-left: ".$left.";";
        }

        if($right != "") {
            $style .= "padding-right: ".$right.";";
        }

        $html .= '<div class="shortcode_padding" style="' .$style. '">';
        $html .= ' '.$content.' ';
        $html .= '</div>';

        return $html;
    }
}

// [projects]
if (!function_exists('shortcode_projects_list')) {
    function shortcode_projects_list($atts, $content = null) {
        global $wp_query;
        global $sbwp_options;
        $args = array(
            "title"                 => "",
            "subtitle"              => "",
            "filter"                => "",
            "columns"               => "3",
            "nav"                   => "true",
            "order_by"              => "date",
            "order"                 => "DESC",
            "number"                => "-1",
            "category"              => "",
            "selected_projects"     => ""
        );
        extract(shortcode_atts($args, $atts));

        // init variables
        $html = "";
        $root = ot_get_option('wpl_projects_page');
        $browseall = __('All Projects', 'thearchitect-wpl');
        $cattitle = __('By sectors', 'thearchitect-wpl');

        if ($title != "") {

            $html .= "<div class='module-title wrap cf' style='padding:0 0 20px 0;'>";
                $html .= "<div class='two_third'>";
                    $html .= "<h2>$title</h2>";
                    if ($subtitle != "") { $html .= "<p>$subtitle</p>"; }
                $html .= "</div>";
                $html .= "<div class='one_third last'>";

                if ($filter != "false") {

                    $html .= "<div class='filter right'>";

                        $html .= '<a class="btn medium black" href="' . get_permalink( $root ) . '">' . $browseall . '</a>';
                        $html .= '<ul><li><a href="#">' . $cattitle . ' <span>&rsaquo;</span></a>';
                        $html .= "<ul class='sectors'>";
                        $taxonomy = 'projects_cat';
                        $tax_terms = get_terms($taxonomy);
                        foreach ($tax_terms as $tax_term) {
                            $html .= '<li><a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all projects in %s", 'thearchitect-wpl' ), $tax_term->name ) . '">' . $tax_term->name . '</a></li>';
                        }
                        $html .= "</ul></li>";
                        $html .= "</ul>";

                    $html .= "</div>";

                }

                $html .= "</div>";
            $html .= "</div>";
        }

        $html .= "<div class='block-grid projects-listing columns-$columns cf'>\n";

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $args = array(
            'post_type' => 'projects',
            'projects_cat' => $category,
            'orderby' => $order_by,
            'order' => $order,
            'posts_per_page' => $number,
            'paged' => $paged
        );

        $project_ids = null;
        if ($selected_projects != "") {
            $project_ids = explode(",", $selected_projects);
            $args['post__in'] = $project_ids;
        }

        $wp_query = new WP_Query($args);
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

            $terms = wp_get_post_terms(get_the_ID(), 'projects_cat');
            $project_text_color = get_post_meta(get_the_ID(), 'wpl_project_text_color', true);
            $project_location = get_post_meta(get_the_ID(), 'wpl_project_location', true);
            if($columns == "2"){
                $html .= "<article class='block-item half-width half-height cf";
            } elseif($columns == "3") {
                $html .= "<article class='block-item third-width third-height cf";
            } elseif($columns == "4") {
                $html .= "<article class='block-item quarter-width quarter-height cf";
            } else {
                $html .= "<article class='block-item third-width third-height cf";
            }
            foreach ($terms as $term) {
                $html .= " cat_$term->term_id";
            }

            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $link = get_permalink();
            $post_featured_image = get_post_thumbnail_id(get_the_ID());
            if ($post_featured_image) {
                $project_thumbnail = wp_get_attachment_image_src( $post_featured_image, 'full', false);
                if ($project_thumbnail) (string)$project_thumbnail = $project_thumbnail[0];
            }

            $html .="' >";

            $html .= "<a href='".$link."' rel='bookmark' title='".$title."'>";
                $html .= "<div class='image' style='background-image: url(".$project_thumbnail.");'></div>";
                $html .= "<div class='text ".$project_text_color."'>";
                    $html .= "<h1>".$title."</h1>";
                    $html .= "<span class='line medium ".$project_text_color."'></span>";
                    $html .= "<p>";
                    if($terms) { $numTerms = count($terms); $i = 1;

                        foreach($terms as $term) {
                            $html .= "$term->name";
                        if($i < $numTerms)
                            $html .= ", ";
                        $i++; }
                    };
                    if($project_location) {
                        $html .= ", $project_location";

                    }
                    $html .= "</p>";
                $html .= "</div>";
            $html .= "</a>";

            $html .= "</article>\n";

        endwhile;

        $html .= "</div>";

        if ($nav == "true") {
            $html .= "<div class='m-all t-all d-all last_col cf'>";
                $html .= bones_page_navi();
            $html .= "</div>";
        }
        wp_reset_query();
        return $html;
    }
}

// [posts_boxe]
if (!function_exists('shortcode_posts_boxe')) {
    function shortcode_posts_boxe($atts, $content = null) {
        global $wp_query;
        global $sbwp_options;
        $args = array(
            "columns"               => "4",
            "title"                 => "",
            "title_tag"             => "h5",
            "nav"                   => "true",
            "order_by"              => "date",
            "order"                 => "DESC",
            "number"                => "-1",
            "category"              => ""
        );
        extract(shortcode_atts($args, $atts));

        $headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $args = array(
            'orderby' => $order_by,
            'order' => $order,
            'posts_per_page' => $number,
            'paged' => $paged,
            'category_name' => $category,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-quote'),
                    'operator' => 'NOT IN',
                )
            )
        );

        // init variables
        $html = "";

        if($title != ""){
            $html .= "<".$title_tag.">".$title."</".$title_tag.">";
        }

        $html .= "<div class='blog_holder_boxed'>";
        $html .= "<ul class='block-grid'>";

        $wp_query = new WP_Query($args);
        while ( $wp_query->have_posts() ) : $wp_query->the_post();

        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $time = get_the_time(get_option('date_format'));

            if($columns == "2"){
                $html .= "<li class='block-item half-width half-height' style='background-color: #1c1c1e'>";
            } elseif($columns == "3") {
                $html .= "<li class='block-item third-width third-height' style='background-color: #1c1c1e'>";
            } elseif($columns == "4") {
                $html .= "<li class='block-item quarter-width quarter-height' style='background-color: #1c1c1e'>";
            } else {
                $html .= "<li class='block-item half-width half-height' style='background-color: #1c1c1e'>";
            }

            $post_thumbnail = '';
            $post_featured_image = get_post_thumbnail_id(get_the_ID());
            if ($post_featured_image) {
                $post_thumbnail = wp_get_attachment_image_src( $post_featured_image, 'thumb-600', false);
                if ($post_thumbnail) (string)$post_thumbnail = $post_thumbnail[0];
            }

            $html .= "<a href='".get_permalink()."' rel='bookmark' title='".$title."'>";
                $html .= "<div class='image' style='background-image: url(".$post_thumbnail.");'></div>";
                $html .= "<div class='text white'>";
                    $html .= "<span class='line small white'></span>";
                    $html .= "<h1>".$title."</h1>";
                $html .= "</div>";
            $html .= "</a>";

        $html .= "</li>\n";

        endwhile;

        $html .= "</ul></div>";

        if ($nav == "true") {
            $html .= "<div class='m-all t-all d-all last_col cf'>";
                $html .= bones_page_navi();
            $html .= "</div>";
        }
        wp_reset_query();
        return $html;
    }
}

// [posts_list]
if (!function_exists('shortcode_posts_list')) {
    function shortcode_posts_list($atts, $content = null) {
        global $wp_query;
        global $sbwp_options;
        $args = array(
            "columns"               => "2",
            "title"                 => "",
            "title_tag"             => "h2",
            "order_by"              => "date",
            "order"                 => "DESC",
            "number"                => "-1",
            "category"              => ""
        );
        extract(shortcode_atts($args, $atts));

        $headings_array = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

        $q = new WP_Query(
            array(
                'orderby' => $order_by,
                'order' => $order,
                'posts_per_page' => $number,
                'category_name' => $category,
                'number' => $number,
            )
        );

        // init variables
        $html = "";

        if($title != ""){
            $html .= "<".$title_tag.">".$title."</".$title_tag.">";
            $html .= "<span class='line small black'></span>";
        }

        $html .= "<div class='blog_content shortcode col-$columns cf'>";

        while ($q->have_posts()) : $q->the_post();

        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $time = get_the_time(get_option('date_format'));
        $categories = get_the_category();
        $separator = ' ';
        $categories_out = '';

        if($categories){
            foreach($categories as $category) {
                $categories_out .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'thearchitect-wpl' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
        }}

        $html .= '<article class="post hentry" id="post-'.get_the_ID().'">';

                $html .= '<div class="post_image">';
                    $html .= '<a href="'.get_permalink().'" target="_self" title=".'.$title.'">';
                        $html .= ''.get_the_post_thumbnail(get_the_ID(), 'blog').'';
                    $html .= '</a>';
                $html .= '</div>';
                $html .= '<div class="entry-header">';
//                    $html .= ''.$categories_out.' <span class="sep">/</span> <time>'.$time.'</time>';
                    $html .= '<h3 class="entry-title"><a href="'.get_permalink().'" target="_self" title=".'.$title.'">'.$title.'</a></h3>';
                    $html .= '<time>'.$time.'</time>';
                $html .= '</div>';
                 $html .= '<div class="post_text">';
                    $html .= ''.get_the_excerpt().'';
                $html .= '</div>';

        $html .= "</article>\n";

        endwhile;
        wp_reset_query();

        $html .= "</div>";
        return $html;
    }
}

// [line]
if (!function_exists('shortcode_line')) {
    function shortcode_line($params = array(), $content = null) {
        extract(shortcode_atts(array(
            'size' => '',
            'color' => 'black'
        ), $params));

        // init variables
        $html = '';

        $html .= '<span class="line '.$size.' '.$color.'"></span>';
        return $html;
    }
}

// [map]
if ( !function_exists( 'shortcode_map' ) ) {

	function shortcode_map ( $params = array(), $content = null ) {
		extract( shortcode_atts( array(
			'address' => '',
			'height' => '400',
			'zoom' => '',
			'saturation' => '0',
			'lightness' => '0',
			'hue' => '',
			'marker' => ''
		), $params ) );

		if( !empty( $address ) ) {
			$options = array(
				'api_key' => ot_get_option( 'wpl_maps_api_server_key' )
			);

			$maps = new WPlook_Google_Maps( $options );

			return $maps->generate_map( array(
				'maps_address' => $address,
				'marker' => $marker,
				'class' => 'google-map',
				'zoom' => $zoom,
				'height' => $height,
				'saturation' => $saturation,
				'lightness' => $lightness,
				'hue' => $hue
			), false );
		}

	}

	add_shortcode( 'map', 'shortcode_map' );

}
if ( !function_exists( 'shortcode_echo' ) ) {

    function shortcode_echo ( $params = array(), $content = null ) {
        return _x($content, '');
    }
}

/**
 * Initialize all shortcodes
 */

add_shortcode('row', 'shortcode_row');
add_shortcode('one_half', 'shortcode_grid_one_half');
add_shortcode('one_third', 'shortcode_grid_one_third');
add_shortcode('two_third', 'shortcode_grid_two_third');
add_shortcode('one_fourth', 'shortcode_grid_one_fourth');
add_shortcode('three_fourth', 'shortcode_grid_three_fourth');
add_shortcode('heading_block', 'shortcode_heading_block');
add_shortcode('text_block', 'shortcode_text_block');
add_shortcode('text_columns', 'shortcode_text_columns');
add_shortcode('button', 'shortcode_button');
//add_shortcode('image_container', 'shortcode_image_container');
//add_shortcode('image_legend', 'shortcode_image_legend');
add_shortcode('list', 'shortcode_list');
add_shortcode('list_images', 'shortcode_list_images');
add_shortcode('icon_text', 'shortcode_icon_text');
add_shortcode('team', 'shortcode_team');
add_shortcode('social_icons', 'shortcode_social_icons');
//add_shortcode('service_table', 'shortcode_service_table');
//add_shortcode('pricing_tables', 'shortcode_pricing_tables');
//add_shortcode('pricing_table', 'shortcode_pricing_table');
add_shortcode('projects_list', 'shortcode_projects_list');
//add_shortcode('posts_boxe', 'shortcode_posts_boxe');
add_shortcode('posts_list', 'shortcode_posts_list');
add_shortcode('line', 'shortcode_line');
add_shortcode('lead', 'shortcode_lead');
add_shortcode('highlight', 'shortcode_highlight');
add_shortcode('code', 'shortcode_code');
add_shortcode('map', 'shortcode_map');
add_shortcode('divider', 'shortcode_divider');
add_shortcode('padding', 'shortcode_padding');
add_shortcode('spacer', 'shortcode_spacer');
add_shortcode('echo', 'shortcode_echo');

/**
 * Add Shortcode within the WP Editor
 */
function add_sc_select(){
    global $shortcode_tags;
     /* ------------------------------------- */
     /* enter names of shortcode to exclude bellow */
     /* ------------------------------------- */
    $exclude = array("caption", "gallery", "playlist", "embed", "wp_caption", "audio", "video", "acf");
    echo ' <select id="sc_select" class="sc_select"><option>Shortcodes</option>';
    foreach ($shortcode_tags as $key => $val){
            if(!in_array($key,$exclude)){
            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
            }
        }
     echo $shortcodes_list;
     echo '</select>';
}
add_action('media_buttons','add_sc_select',11);

function button_js() {
        echo '<script type="text/javascript">
        jQuery(document).ready(function(){
           jQuery(".sc_select").change(function() {
               wpActiveEditor = jQuery( "textarea.mceEditor,textarea.wp-editor-area", jQuery(this).closest(".wp-media-buttons").parent().parent() ).attr( "id" );
               send_to_editor(jQuery(":selected", this).val());
               jQuery(this).val("Shortcodes");
               return false;
           });
        });
        </script>';
}
add_action('admin_head', 'button_js');

?>
