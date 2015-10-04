$(function () {
    $.wa.site.yatableauAction = function () {
        //$("#s-content").text('Yatableau');
        this.savePanel(false);
        $("#s-content").load(
            '?'+$.param({
                plugin: 'yatableau',
                module: 'domainsettings',
                domain_id: this.domain
            }),
            function () {
                $.wa.site.active($("#s-plugin-yatableau-settings"));
            });
    }
});
