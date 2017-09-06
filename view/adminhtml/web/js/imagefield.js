/**
 * imagefield
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@gmail.com
 */

/*jshint jquery:true*/
define([
    "jquery",
    "jquery/ui"
], function ($) {
    "use strict";

    $.widget('staempfli_widgetextrafields.imagefield', {
        options: {
            imagePathInputId: null,
            imagePreviewDivId: null,
            mediaUrl: null
        },

        _create: function() {
            this.getImagePathInput().on('change', $.proxy(this.updateImage, this));
            this.getDeleteButton().on('click', $.proxy(this.deleteImage, this));
        },

        getImagePathInput: function() {
            return $('#' + this.options.imagePathInputId);
        },

        getImageDiv: function() {
            return $('#' + this.options.imagePreviewDivId);
        },

        getDeleteButton: function() {
            return this.getImageDiv().find('button.action-remove').first();
        },

        getLinkElement: function() {
            return this.getImageDiv().find('a').first();
        },

        getImgElement: function() {
            return this.getImageDiv().find('img').first();
        },

        updateImage: function(event) {
            var newImagePath = this.getImagePathInput().val();
            var newImageUrl = this.options.mediaUrl + '/' + newImagePath;
            this.getLinkElement().attr('href', newImageUrl);
            this.getImgElement().attr('src', newImageUrl);
            this.getImageDiv().show();
        },

        deleteImage: function(event) {
            this.getImagePathInput().val('');
            this.getLinkElement().attr('href', '');
            this.getImgElement().attr('src', '');
            this.getImageDiv().hide();
        }

    });

    return $.staempfli_widgetextrafields.imagefield;
});