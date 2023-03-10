/**
 * Scripts within the customizer controls window.
**/

(function( $, api ) {
    wp.customize.bind('ready', function() {

        /* === Radio Image Control === */
        api.controlConstructor['radio-color'] = api.Control.extend( {
            ready: function() {
                var control = this;

                $( 'input:radio', control.container ).change(
                    function() {
                        control.setting.set( $( this ).val() );
                    }
                );
            }
        } );

         // Sortable sections
        jQuery( 'ul.collective-news-sortable-list' ).sortable({
            handle: '.collective-news-drag-handle',
            axis: 'y',
            update: function( e, ui ){
                jQuery('input.collective-news-sortable-input').trigger( 'change' );
            }
        });

        // Sortable sections
        jQuery( "body" ).on( 'hover', '.collective-news-drag-handle', function() {
            jQuery( 'ul.collective-news-sortable-list' ).sortable({
                handle: '.collective-news-drag-handle',
                axis: 'y',
                update: function( e, ui ){
                    jQuery('input.collective-news-sortable-input').trigger( 'change' );
                }
            });
        });

        /* On changing the value. */
        jQuery( "body" ).on( 'change', 'input.collective-news-sortable-input', function() {
            /* Get the value, and convert to string. */
            this_checkboxes_values = jQuery( this ).parents( 'ul.collective-news-sortable-list' ).find( 'input.collective-news-sortable-input' ).map( function() {
                return this.value;
            }).get().join( ',' );

            /* Add the value to hidden input. */
            jQuery( this ).parents( 'ul.collective-news-sortable-list' ).find( 'input.collective-news-sortable-value' ).val( this_checkboxes_values ).trigger( 'change' );

        });

        // Deep linking for counter section to about section.
        jQuery('.collective-news-edit').click(function(e) {
            e.preventDefault();
            var jump_to = jQuery(this).attr( 'data-jump' );
            wp.customize.section( jump_to ).focus()
        });

        $('#sub-accordion-section-collective_news_topbar').css( 'display', 'none' );
    });
})( jQuery, wp.customize );

jQuery( document ).ready(function($) {
    $( document ).on( 'click', '.customize_multi_add_field', collective_news_customize_multi_add_field )
        .on( 'change', '.customize_multi_single_field', collective_news_customize_multi_single_field )
        .on( 'click', '.customize_multi_remove_field', collective_news_customize_multi_remove_field )

    /********* Multi Input Custom control ***********/
    $( '.customize_multi_input' ).each(function() {
        var $this = $( this );
        var multi_saved_value = $this.find( '.customize_multi_value_field' ).val();
        if (multi_saved_value.length > 0) {
            var multi_saved_values = multi_saved_value.split( "|" );
            $this.find( '.customize_multi_fields' ).empty();
            var $control = $this.parents( '.customize_multi_input' );
            $.each(multi_saved_values, function( index, value ) {
                $this.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="' + value + '" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
            });
        }
    });

    function collective_news_customize_multi_add_field(e) {
        var $this = $( e.currentTarget );
        e.preventDefault();
            var $control = $this.parents( '.customize_multi_input' );
            $control.find( '.customize_multi_fields' ).append( '<div class="set"><input type="text" value="" class="customize_multi_single_field" /><span class="customize_multi_remove_field"><span class="dashicons dashicons-no-alt"></span></span></div>' );
            collective_news_customize_multi_write( $control );
    }

    function collective_news_customize_multi_single_field() {
        var $control = $( this ).parents( '.customize_multi_input' );
        collective_news_customize_multi_write( $control );
    }

    function collective_news_customize_multi_remove_field(e) {
        e.preventDefault();
        var $this = $( this );
        var $control = $this.parents( '.customize_multi_input' );
        $this.parent().remove();
        collective_news_customize_multi_write( $control );
    }

    function collective_news_customize_multi_write( $element) {
        var customize_multi_val = '';
        $element.find( '.customize_multi_fields .customize_multi_single_field' ).each(function() {
            customize_multi_val += $( this ).val() + '|';
        });
        $element.find( '.customize_multi_value_field' ).val( customize_multi_val.slice( 0, -1 ) ).change();
    }       
});

(function(api) {

    const collective_news_section_lists = ['breaking-news','banner','recent-posts','posts-grid','subscription'];
    collective_news_section_lists.forEach(collective_news_homepage_scroll);

    function collective_news_homepage_scroll(item, index) {
        // Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
        item = item.replace(/-/g, '_');
        wp.customize.section('collective_news_' + item + '_section', function(section) {
            section.expanded.bind(function(isExpanding) {
                // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
                wp.customize.previewer.send(item, { expanded: isExpanding });
            });
        });
    }
})(wp.customize);