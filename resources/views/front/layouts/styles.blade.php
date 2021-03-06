<style amp-custom>
    /* NORMALIZE v 8.0.1 */
    @include('admin.layouts.normalize')

    /* BASSCSS TYPE SCALE */
    @include('admin.layouts.css.basscss-type-scale')

    /* BASSCSS TYPOGRAPHY */
    @include('admin.layouts.css.basscss-typography')

    /* BASSCSS LAYOUT */
    @include('admin.layouts.css.basscss-layout')

    /* BASSCSS ALIGN */
    @include('admin.layouts.css.basscss-align')

    /* BASSCSS MARGIN */
    @include('admin.layouts.css.basscss-margin')

    /* BASSCSS PADDING */
    @include('admin.layouts.css.basscss-padding')

    /* BASSCSS GRID */
    @include('admin.layouts.css.basscss-grid')

    /* BASSCSS FLEXBOX */
    @include('admin.layouts.css.basscss-flexbox')

    /* BASSCSS POSITION */
    @include('admin.layouts.css.basscss-position')

    /* BASSCSS BORDER */
    @include('admin.layouts.css.basscss-border')

    /* BASSCSS HIDE */
    @include('admin.layouts.css.basscss-hide')

    /* BASSCSS FORMS */
    @include('admin.layouts.css.basscss-forms')

    /* BASSCSS BTN */
    @include('admin.layouts.css.basscss-btn')

    /* BASSCSS BTN OUTLINE */
    @include('admin.layouts.css.basscss-btn-outline')

    /* BASSCSS BTN PRIMARY */
    @include('admin.layouts.css.basscss-btn-primary')

    /* BASSCSS BTN SIZES */
    @include('admin.layouts.css.basscss-btn-sizes')

    /* BASSCSS COLORS */
    @include('admin.layouts.css.basscss-colors')

    /* BASSCSS BACKGROUND COLORS */
    @include('admin.layouts.css.basscss-background-colors')

    /* BASSCSS BACKGROUND IMAGES */
    @include('admin.layouts.css.basscss-background-images')

    /* BASSCSS BORDER COLORS */
    @include('admin.layouts.css.basscss-border-colors')

    /* BASSCSS DARKEN */
    @include('admin.layouts.css.basscss-darken')

    /* BASSCSS LIGHTEN */
    @include('admin.layouts.css.basscss-lighten')

    /* BASSCSS INPUT RANGE */
    @include('admin.layouts.css.basscss-input-range')

    /* BASSCSS PROGRESS */
    @include('admin.layouts.css.basscss-progress')

    /* BASSCSS ALL */
    @include('admin.layouts.css.basscss-all')

    /* BASSCSS MEDIA OBJECT */
    @include('admin.layouts.css.basscss-media-object')

    /* BASSCSS HIGHLIGHT */
    @include('admin.layouts.css.basscss-highlight')

    /* BASSCSS HIGHLIGHT DARK */
    @include('admin.layouts.css.basscss-highlight-dark')

    body {
        font-family:roboto;
    }
    .hamburger{
        /* font-size: 1.5em; */
        /* display:block;
        cursor: pointer; */
        /* position: fixed; */
        /* top: 0; */
        /* right: 0; */
        /* width: 20px;
        height: 20px; */
        /* background: #03A9F4; */
        /* z-index: 1; */
    }
    header {
        /* background: #9C27B0; */
        /* height: 100px; */
    }
    article {
        /* background: #FFD54F */
    }
    nav {
        margin: 0px;
    }
    aside {
        display: none;
    }
    ul.nav-container {
        display: block;
        padding: 0;
        /* background: #4CAF50; */
        margin: 0px;
        width: 300px;
    }
    ul.nav-container > * {
        height: 30px;
        display: block;
        border-bottom: 1px solid #EEE;
        padding: 2px;
    }
    .selected {
        background: #FF9800;
    }
    @media(min-width:320px) {
        /*  */
    }
    @media(min-width:375px) {
        /*  */
    }
    @media(min-width:425px) {
        /*  */
    }
    @media(min-width:769px) {
        /* overflow: scroll MUST BE on the `toolbar` */
        nav[toolbar] {
            max-height: calc(100vh - 100px);
            overflow: auto;
        }
        .hamburger {
            display: none;
        }
        main {
            display: flex;
            flex-direction: row;
        }
        aside {
            display: flex;
            flex-direction: column;
        }
        article {
            flex: 1
        }
    }
    @media(min-width:1024px) {
        /*  */
    }
    @media(min-width::1440px) {
        /*  */
    }
    @media(min-width:2560px) {
        /*  */
    }

    /* TESTS */
</style>
