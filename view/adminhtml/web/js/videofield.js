/**
 * videofield
 *
 * @copyright Copyright © 2019 Staempfli AG. All rights reserved.
 * @author    florian.auderset@staempfli.com
 */

/*jshint jquery:true*/
define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('staempfli_widgetextrafields.videofield', {
        options: {
            videoPathInputSelector: null,
            videoPreviewDivSelector: null,
            videoDeleteButtonSelector: null,
            mediaUrl: null
        },

        _create: function() {
            this.getVideoPathInput().on('change', $.proxy(this.updateVideo, this));
            this.getDeleteButton().on('click', $.proxy(this.deleteVideo, this));
        },

        getVideoPathInput: function() {
            return this.element.find(this.options.videoPathInputSelector).first();
        },

        getDeleteButton: function() {
            return this.element.find(this.options.videoDeleteButtonSelector).first();
        },

        getPreviewVideoDiv: function() {
            return this.element.find(this.options.videoPreviewDivSelector).first();
        },

        getLinkElement: function() {
            return this.getPreviewVideoDiv().find('a').first();
        },

        getVideoElement: function() {
            return this.getPreviewVideoDiv().find('video').first();
        },

        updateVideo: function() {
            var newVideoPath = this.getVideoPathInput().val();
            var newVideoUrl = this.options.mediaUrl + '/' + newVideoPath;
            this.getLinkElement().attr('href', newVideoUrl);
            this.getImgElement().attr('src', newVideoUrl);
            this.getPreviewVideoDiv().show();
        },

        deleteVideo: function() {
            this.getVideoPathInput().val('');
            this.getLinkElement().attr('href', '');
            this.getVideoElement().removeAttribute('src');
            this.getVideoElement().load();
            this.getPreviewVideoDiv().hide();
        }

    });

    return $.staempfli_widgetextrafields.videofield;
});