<?php
/**
 * 
 * Animation styles - regular, Entry effects
 * @since 2.8
 * @since 3.3.5 added entry effects
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Animations' ) ) :

class HT_CTC_Animations {


    // public function __construct() {
        // $this->base();
    // }

    
    
    /**
     * Animations
     * 
     * Based of animations - with delay, iteration
     * and then calls the necessary animation function.
     * 
     * @param string $a             animation type (bounce, .. )
     * @param string $ad            animation duration (1s)
     * @param string $d             time delay (1s)
     * @param int|[string] $i       interation count 1
     * 
     * $a($a) - it like calling bounce('bounce')
     */
    function animations( $a, $ad, $d, $i ) {
        ?>
        <style id="ht-ctc-animations">.ht_ctc_animation{animation-duration:<?php echo esc_attr($ad) ?>;animation-fill-mode:both;animation-delay:<?php echo esc_attr($d) ?>;animation-iteration-count:<?php echo esc_attr($i) ?>;}
        <?php
        if (  $a && method_exists( $this, $a ) ) {
            // call the animation function
            $this->$a("ht_ctc_an_$a");
        }
        ?>
        </style>
        <?php
    }

    /**
     * Entry Animations
     * 
     * $a is a callback function name e.g. center, corner, bounce, flash, pulse
     */
    function entry( $a, $ad, $d, $i ) {
        ?>
        <style id="ht-ctc-entry-animations">.ht_ctc_entry_animation{animation-duration:<?php echo esc_attr($ad) ?>;animation-fill-mode:both;animation-delay:<?php echo esc_attr($d) ?>;animation-iteration-count:<?php echo esc_attr($i) ?>;}
        <?php
        // Check if $a is defined and maps to a real method
        if ( $a && method_exists( $this, $a ) ) {
            $this->$a("ht_ctc_an_entry_$a");
        }
        ?>
        </style>
        <?php
    }

    // compress css code 
    // function compress_css($code) {
    //     // Remove comments
    //     $code = preg_replace('!/\*.*?\*/!s', '', $code);
    //     // Remove whitespace
    //     $code = preg_replace('/\s+/', ' ', $code);
    //     $code = preg_replace('/\s*([{}|:;,])\s+/', '$1', $code);
    //     $code = preg_replace('/;\s*}/', '}', $code); // optional semicolon before closing brace
    //     $code = trim($code);
    //     return $code;
    // }

    // function compress_css2($code) {
    //     // Remove CSS comments
    //     $code = preg_replace('!/\*.*?\*/!s', '', $code);
    //     // Remove newlines, tabs, excess spaces
    //     $code = preg_replace('/\s+/', ' ', $code);
    //     // Remove spaces around CSS syntax characters
    //     $code = preg_replace('/\s*([{};:>,])\s*/', '$1', $code);
    //     // Optional: remove semicolon before closing brace
    //     $code = preg_replace('/;}/', '}', $code);
    //     return trim($code);
    // }


    // ob_start();
    // $this->$a($selector);
    // $css = ob_get_clean();
    // echo $this->compress_css($css);
    

    // Animations types css for main, entry

    function bounce($a) {
        ?>
        @keyframes bounce{from,20%,53%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1);transform:translate3d(0,0,0)}40%,43%{animation-timing-function:cubic-bezier(0.755,0.05,0.855,0.06);transform:translate3d(0,-30px,0) scaleY(1.1)}70%{animation-timing-function:cubic-bezier(0.755,0.05,0.855,0.06);transform:translate3d(0,-15px,0) scaleY(1.05)}80%{transition-timing-function:cubic-bezier(0.215,0.61,0.355,1);transform:translate3d(0,0,0) scaleY(0.95)}90%{transform:translate3d(0,-4px,0) scaleY(1.02)}}.<?php echo esc_attr($a) ?>{animation-name:bounce;transform-origin:center bottom}
        <?php
    }

    function flash($a) {
        ?>
        @keyframes flash{from,50%,to{opacity:1}25%,75%{opacity:0}}.<?php echo esc_attr($a) ?>{animation-name:flash}
        <?php
    }

    function pulse($a) {
        ?>
        @keyframes pulse{from{transform:scale3d(1,1,1)}50%{transform:scale3d(1.05,1.05,1.05)}to{transform:scale3d(1,1,1)}}.<?php echo esc_attr($a) ?>{animation-name:pulse;animation-timing-function:ease-in-out}
        <?php
    }

    function heartbeat($a) {
        // todo: in heartbeat() and bounceIn()
        // In both methods, you have two conflicting animation-duration declarations:
        // animation-duration:calc(1s * 1.3);
        // animation-duration:calc(var(1) * 1.3);
        // Only one is necessary. The second one using calc(var(1)...) is invalid unless you’re dynamically setting a CSS variable named --1, which you’re not doing.
        ?>
        @keyframes heartBeat{0%{transform:scale(1)}14%{transform:scale(1.3)}28%{transform:scale(1)}42%{transform:scale(1.3)}70%{transform:scale(1)}}.<?php echo esc_attr($a) ?>{animation-name:heartBeat;animation-duration:calc(1s * 1.3);animation-duration:calc(var(1) * 1.3);animation-timing-function:ease-in-out}
        <?php
    }

    function flip($a) {
        ?>
        @keyframes flip{from{transform:perspective(400px) scale3d(1,1,1) translate3d(0,0,0) rotate3d(0,1,0,-360deg);animation-timing-function:ease-out}40%{transform:perspective(400px) scale3d(1,1,1) translate3d(0,0,150px) rotate3d(0,1,0,-190deg);animation-timing-function:ease-out}50%{transform:perspective(400px) scale3d(1,1,1) translate3d(0,0,150px) rotate3d(0,1,0,-170deg);animation-timing-function:ease-in}80%{transform:perspective(400px) scale3d(.95,.95,.95) translate3d(0,0,0) rotate3d(0,1,0,0deg);animation-timing-function:ease-in}to{transform:perspective(400px) scale3d(1,1,1) translate3d(0,0,0) rotate3d(0,1,0,0deg);animation-timing-function:ease-in}}.<?php echo esc_attr($a) ?>{backface-visibility:visible;animation-name:flip}
        <?php
    }

    function bounceInLeft($a) {
        ?>
        @keyframes bounceInLeft{from,60%,75%,90%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1)}0%{opacity:0;transform:translate3d(-3000px,0,0) scaleX(3)}60%{opacity:1;transform:translate3d(25px,0,0) scaleX(1)}75%{transform:translate3d(-10px,0,0) scaleX(0.98)}90%{transform:translate3d(5px,0,0) scaleX(0.995)}to{transform:translate3d(0,0,0)}}.<?php echo esc_attr($a) ?>{animation-name:bounceInLeft}
        <?php
    }


    function bounceInRight($a) {
        ?>
        @keyframes bounceInRight{from,60%,75%,90%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1)}from{opacity:0;transform:translate3d(3000px,0,0) scaleX(3)}60%{opacity:1;transform:translate3d(-25px,0,0) scaleX(1)}75%{transform:translate3d(10px,0,0) scaleX(0.98)}90%{transform:translate3d(-5px,0,0) scaleX(0.995)}to{transform:translate3d(0,0,0)}}.<?php echo esc_attr($a) ?>{animation-name:bounceInRight}
        <?php
    }

    function bounceIn($a) {
        ?>
        @keyframes bounceIn{from,20%,40%,60%,80%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1)}0%{opacity:0;transform:scale3d(0.3,0.3,0.3)}20%{transform:scale3d(1.1,1.1,1.1)}40%{transform:scale3d(0.9,0.9,0.9)}60%{opacity:1;transform:scale3d(1.03,1.03,1.03)}80%{transform:scale3d(0.97,0.97,0.97)}to{opacity:1;transform:scale3d(1,1,1)}}.<?php echo esc_attr($a) ?>{animation-duration:calc(1s * 0.75);animation-duration:calc(var(1) * 0.75);animation-name:bounceIn}
        <?php
    }

    function bounceInDown($a) {
        ?>
        @keyframes bounceInDown{from,60%,75%,90%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1)}0%{opacity:0;transform:translate3d(0,-3000px,0) scaleY(3)}60%{opacity:1;transform:translate3d(0,25px,0) scaleY(0.9)}75%{transform:translate3d(0,-10px,0) scaleY(0.95)}90%{transform:translate3d(0,5px,0) scaleY(0.985)}to{transform:translate3d(0,0,0)}}.<?php echo esc_attr($a) ?>{animation-name:bounceInDown}
        <?php
    }

    function bounceInUp($a) {
        ?>
        @keyframes bounceInUp{from,60%,75%,90%,to{animation-timing-function:cubic-bezier(0.215,0.61,0.355,1)}from{opacity:0;transform:translate3d(0,3000px,0) scaleY(5)}60%{opacity:1;transform:translate3d(0,-20px,0) scaleY(0.9)}75%{transform:translate3d(0,10px,0) scaleY(0.95)}90%{transform:translate3d(0,-5px,0) scaleY(0.985)}to{transform:translate3d(0,0,0)}}.<?php echo esc_attr($a) ?>{animation-name:bounceInUp}
        <?php
    }


    // local
    function center($a) {
        ?>
        @keyframes center{from{transform:scale(0);}to{transform:scale(1);}}.<?php echo esc_attr($a) ?>{animation: center .25s;}
        <?php
    }

    // local
    function corner($a) {
        ?>
        @keyframes corner{0%{transform: scale(0.3);opacity: 0;transform-origin: bottom var(--side, right);}100% {transform: scale(1);opacity: 1;transform-origin: bottom var(--side, right);}}.<?php echo esc_attr($a) ?> {animation: corner 0.12s ease-out;animation-fill-mode: both;}
        <?php
    }

    
    // zoomin not using ( using center() )
    function zoomIn($a) {
        ?>
        @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale3d(0.3, 0.3, 0.3);
        }

        50% {
            opacity: 1;
        }
        }
        .<?php echo esc_attr($a) ?> {
        animation: zoomIn .25s;
        /* animation-name: zoomIn; */
        }
        <?php
    }


    // local
    // have to improve, add bounce effect..
    function bottomRight($a) {
        ?>
        @keyframes bounceInBR {
        0% {
            transform: translateY(1000px) translateX(1000px);
            opacity: 0;
        }
        100% {
            transform: translateY(0) translateX(0);
            opacity: 1;
        }
        }
        .<?php echo esc_attr($a) ?> {
            animation: bounceInBR 0.5s linear both;
        }
        <?php
    }


}

// new HT_CTC_Animations();

endif; // END class_exists check