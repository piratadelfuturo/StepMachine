(function( $ ) {

  $.widget( "boom.imageManager", {


    // These options will be used as defaults

    options: {
      clear: null
    },


    // Set up the widget
    _create: function() {

        var self = this;
        console.log(this);

    },


    // Use the _setOption method to respond to changes to options

    _setOption: function( key, value ) {

      switch( key ) {

        case "clear":
          // handle changes to clear option

          break;

      }

      // In jQuery UI 1.8, you have to manually invoke the _setOption method from the base widget

      $.Widget.prototype._setOption.apply( this, arguments );
      // In jQuery UI 1.9 and above, you use the _super method instead
      this._super( "_setOption", key, value );

    },

    // Use the destroy method to clean up any modifications your widget has made to the DOM

    destroy: function() {

      // In jQuery UI 1.8, you must invoke the destroy method from the base widget

      $.Widget.prototype.destroy.call( this );
      // In jQuery UI 1.9 and above, you would define _destroy instead of destroy and not call the base method

    }

  });

}( jQuery ) );

