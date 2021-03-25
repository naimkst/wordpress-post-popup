(function($) {

	"use strict";
	// alert('working....');

    jQuery( "h3.post-title.entry-title a" ).addClass( "clit_post" );
    jQuery(document).ready(function($) {

        jQuery('.clit_post').click(function(event) {
            event.preventDefault();

            var id = jQuery(this).data('id');

            jQuery.ajax({
                type: 'POST',
                url: '/wordpress/wp-admin/admin-ajax.php',
                data: {'action' : 'ajax_request', 'id': this.id},
                dataType: 'json',
                success: function(data) {
                    jQuery('#staticBackdrop').remove();
                    console.log(data);
                    var html = "<div class=\"modal fade popup-modal\" id=\"staticBackdrop\" data-backdrop=\"static\" data-keyboard=\"false\" tabindex=\"-1\"\n" +
                        "     aria-labelledby=\"staticBackdropLabel\" aria-hidden=\"true\">\n" +
                        "\t<div class=\"modal-dialog modal-dialog-centered\">\n" +
                        "\t\t<div class=\"modal-content\">\n" +
                        "\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n" +
                        "\t\t\t\t<span aria-hidden=\"true\">&times;</span>\n" +
                        "\t\t\t</button>\n" +
                        "\t\t\t<div class=\"modal-body\">\n" +
                        "\t\t\t\t<div class=\"container p-0\">\n" +
                        "\t\t\t\t\t<div class=\"row no-gutters m-0 align-items-center\">\n" +
                        "\t\t\t\t\t\t<div class=\"col-lg-5\">\n" +
                        "\t\t\t\t\t\t\t<div class=\"modal-left\">\n" +
                        "\t\t\t\t\t\t\t\t<span class=\"tag\">new</span>\n" +
                        "\t\t\t\t\t\t\t\t<img src="+data.image+" alt=\"\">\n" +
                        "\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t<div class=\"col-lg-7\">\n" +
                        "\t\t\t\t\t\t\t<div class=\"content\">\n" +
                        "\t\t\t\t\t\t\t\t<h3 class=\"content-title ddd\">"+data.post.post_title+"</h3>\n" +
                        "\t\t\t\t\t\t\t\t<p>"+data.post.post_content.substring(0,200)+"</p>\n" +
                        "\t\t\t\t\t\t\t\t<a class=\"btn popup-content-btn\" href=\""+data.url+"\">more..</a>\n" +
                        "\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t<div class=\"row mt-3 align-items-center\">\n" +
                        "\t\t\t\t\t\t<div class=\"col-lg-6\">\n" +
                        "\t\t\t\t\t\t\t<div class=\"row align-items-center\">\n" +
                        "\t\t\t\t\t\t\t\t<div class=\"col-lg-2\">\n" +
                        "\t\t\t\t\t\t\t\t\t<div class=\"modal-avater\">\n" +
                        "\t\t\t\t\t\t\t\t\t\t"+data.avatar+"\n" +
                        "\t\t\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t\t\t<div class=\"col-lg-10\">\n" +
                        "\t\t\t\t\t\t\t\t\t<div class=\"author-content\">\n" +
                        "\t\t\t\t\t\t\t\t\t\t<h4>Admin</h4>\n" +
                        "\t\t\t\t\t\t\t\t\t\t<p>  </p>\n" +
                        "\t\t\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t\t<div class=\"col-lg-6\">\n" +
                        "\t\t\t\t\t\t\t<ul class=\"popup-option-list\">\n" +
                        "\t\t\t\t\t\t\t\t<li><img src=\"https://beta15.atlantaintelligencebeta.com/wp-content/uploads/2021/03/share.svg\" alt=\"\"></li>\n" +
                        "\t\t\t\t\t\t\t\t<li><img src=\"https://beta15.atlantaintelligencebeta.com/wp-content/uploads/2021/03/bookmark-tag.svg\" alt=\"\"></li>\n" +
                        "\t\t\t\t\t\t\t\t<li><img src=\"https://beta15.atlantaintelligencebeta.com/wp-content/uploads/2021/03/chat.svg\" alt=\"\"></li>\n" +
                        "\t\t\t\t\t\t\t</ul>\n" +
                        "\t\t\t\t\t\t</div>\n" +
                        "\t\t\t\t\t</div>\n" +
                        "\t\t\t\t</div>\n" +
                        "\t\t\t</div>\n" +
                        "\t\t</div>\n" +
                        "\t</div>\n" +
                        "</div>";
                    jQuery("#main-container").append(html);
               jQuery("#staticBackdrop").modal('show');
                }
            });

            return false;
        });
    });
})(window.jQuery);
