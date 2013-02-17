function amChartInited(chart_id)
{
    dready();
}

function amError(chart_id,message)
{
    alert(message);
}

function dready()
{
    $.ajax({
        url   : window.location.href + '/analytics_profiles',
        cache: true,
        type:'POST',
        success: function(data)
        {
            var profiles=data.split('|');
            var i=0;
            $.each(profiles,function(index,profile)
            {
                i++;
                var row = profile.split(',');
                var opt = document.createElement("option");
                opt.text = row[1];
                opt.value = row[0];
                if (i==1)
                {
                    opt.selected = true;
                } else {
                    opt.selected = false;
                }

                console.log(opt);

                $("#dashboard_profile_id").append(opt);
            })

            load_analytics($('#months').val(), $('#year').val(), $('#dashboard_profile_id').val());
        }
     });

     function load_analytics(month, year, profile)
     {

        $.ajax({
            url   : window.location.href + '/xml_data',
            cache : true,
            type  : 'POST',

            data:{month:month, year:year, profile:profile},
            success: function(data)
            {
                if(data)
                {
                    //$('#linechart').set('style','display:block');
                    document.getElementById('amline').setData(data);
                } else {
                    document.getElementById('amline').className = 'hiddenswf';
                }
            }
        })

        $.ajax({
            url   : window.location.href + '/statistics',
            cache : true,
            type : 'POST',
            data:{month:month, year:year, profile:profile},
            success: function(data)
            {
                if(data)
                {
                    //$('#linechart').set('style','display:block');
                    $('#dashboard').html(data);
                } else {
                    document.getElementById('amline').className = 'hiddenswf';
                }
            }
        })
    }

    $('#months').change(function()
    {
        load_analytics($('#months').val(), $('#year').val(), $('#dashboard_profile_id').val());
    });

    $('#year').change(function()
    {
        load_analytics($('#months').val(), $('#year').val(), $('#dashboard_profile_id').val());
    });

    $('#dashboard_profile_id').change(function()
    {
        load_analytics($('#months').val(), $('#year').val(), $('#dashboard_profile_id').val());
    });

}
