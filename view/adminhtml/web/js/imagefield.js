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
            imagePathInputSelector: null,
            imagePreviewDivSelector: null,
            imageDeleteButtonSelector: null,
            mediaUrl: null
        },

        _create: function() {
            this.getImagePathInput().on('change', $.proxy(this.updateImage, this));
            this.getDeleteButton().on('click', $.proxy(this.deleteImage, this));
        },

        getImagePathInput: function() {
            return this.element.find(this.options.imagePathInputSelector).first();
        },

        getDeleteButton: function() {
            return this.element.find(this.options.imageDeleteButtonSelector).first();
        },

        getPreviewImageDiv: function() {
            return this.element.find(this.options.imagePreviewDivSelector).first();
        },

        getLinkElement: function() {
            return this.getPreviewImageDiv().find('a').first();
        },

        getImgElement: function() {
            return this.getPreviewImageDiv().find('img').first();
        },

        updateImage: function(event) {
            var newImagePath = this.getImagePathInput().val();
            var newImageUrl = this.options.mediaUrl + '/' + newImagePath;
            this.getLinkElement().attr('href', newImageUrl);
            this.getImgElement().attr('src', newImageUrl);
            this.getPreviewImageDiv().show();
        },

        deleteImage: function(event) {
            this.getImagePathInput().val('');
            this.getLinkElement().attr('href', '');
            this.getImgElement().attr('src', '');
            this.getPreviewImageDiv().hide();
        }

    });

    return $.staempfli_widgetextrafields.imagefield;
});