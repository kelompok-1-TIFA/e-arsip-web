var grafik = {

    dashboard: function() {

        if ($('#suratMasukCart').length != 0 || $('#suratKeluarCart').length != 0) {
            datasuratMasukCart = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    [12, 17, 7, 17, 23, 18, 38,400,500,23,56,1000]
                ]
            };
            optionssuratMasukCart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: 1000,
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                },
            }
            var suratMasukCart = new Chartist.Line('#suratMasukCart', datasuratMasukCart, optionssuratMasukCart);
            md.startAnimationForLineChart(suratMasukCart);

            datasuratKeluarCart = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    [230, 750, 450, 300, 280, 240, 200, 190]
                ]
            };
            optionssuratKeluarCart = {
                lineSmooth: Chartist.Interpolation.cardinal({
                    tension: 0
                }),
                low: 0,
                high: 1000, 
                chartPadding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                }
            }
            var suratKeluarCart = new Chartist.Line('#suratKeluarCart', datasuratKeluarCart, optionssuratKeluarCart);
            md.startAnimationForLineChart(suratKeluarCart);
        }
    }
}