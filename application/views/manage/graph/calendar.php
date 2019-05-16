<!--<link href='<?php echo base_url(); ?>assets-ds/fullcalendar/resource/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>assets-ds/fullcalendar/resource/fullcalendar.print.min.css' rel='stylesheet' media='print' />-->
<style>
    #calendar {
        width: 100%;
        margin: 0 auto;
    }
    td.descc p { font-size:11px; }
    table.line_bott tr td { border-bottom:1px solid #4aa23c; }
</style>
<div id='calendar'></div>
<div id="fullCalModal" class="modal fade large">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 id="modalTitle" style="text-align:center; font-weight: bold;" class="modal-title"></h4>
            </div>
            <div class="row">
                <div class="col-md-12">     
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mg-b-md text-right pull-right">
                        <h3><span id="proses" class="btn btn-primary btn-xs"></span> <i class="fa fa-gavel"></i></h3>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mg-b-md text-left pull-left">
                        <h3><span id="date"></span> <i class="fa fa-calendar-check-o"></i></h3>
                    </div>

                    <table class="line_bott table" style="width:95%; margin:0px auto;">   
                    
                        <tr>
                            <td style="padding:5px; width: 140px; font-weight: bold; color:#0098a3; "><i class="fa fa-bullhorn"></i> Complaint
                                <hr style="padding:0px; margin:0px;">
                                <b  style="margin-left:10px; font-size:11px; color:#0098a3;">Type</b></b>
                                <hr style="padding:0px; margin:0px;">
                                <b  style="margin-left:10px; font-size:11px; color:#0098a3;">Project - Product</b>
                                <hr style="padding:0px; margin:0px;">
                                <b  style="margin-left:10px; font-size:11px; color:#0098a3;">Source</b>
                                <hr style="padding:0px; margin:0px;">
                                <b  style="margin-left:10px; font-size:11px; color:#0098a3;">Solve Type</b>
                                <hr style="padding:0px; margin:0px;">
                                <b  style="margin-left:10px; font-size:11px; color:#0098a3;">Users</b></td>
                            <td style="padding:5px; width: 20px; vertical-align: top;">:</td>
                            <td style="padding:5px; min-width: 160px; text-align: left;"><span id="complaint"></span>
                                <hr style="padding:0px; margin:0px;">
                                <b style="margin-left:10px; font-size:11px;" ><span id="typee"></span></b>
                                <hr style="padding:0px; margin:0px;">
                                <b style="margin-left:10px; font-size:11px;" ><span id="proj_prod"></span></b>
                                <hr style="padding:0px; margin:0px;">
                                <b style="margin-left:10px; font-size:11px;" ><span id="sourcee"></span></b>
                                <hr style="padding:0px; margin:0px;">
                                <b style="margin-left:10px; font-size:11px;" ><span id="solve"></span></b>
                                <hr style="padding:0px; margin:0px;">
                                <b style="margin-left:10px; font-size:11px;" ><span class="label label-danger" id="users"></span></b></td>
                        </tr>     
                        <tr>
                            <td style="padding:5px; width: 140px; font-weight: bold; color:#0098a3;"><i class="fa fa-tasks"></i> Solve Progress</td>
                            <td style="padding:5px; width: 20px">:</td>
                            <td style="padding:5px; min-width: 160px;"><div id="solve_prog"></div></td>
                        </tr>
                        <tr>
                            <td style="padding:5px; width: 140px; font-weight: bold; color:#0098a3;"><i class="fa fa-pencil-square"></i> Note<hr style="padding:0px; margin:0px;"><i class="fa fa-check-circle"></i> Solved Desc</td>
                            <td style="padding:5px; width: 20px">:</td>
                            <td style="padding:5px; min-width: 160px"><span id="notee"></span><hr style="padding:0px; margin:0px;"><span id="sol_desc"></span></td>
                        </tr> 
                        <tr>
                            <td style="padding:5px; width: 140px; font-weight: bold; color:#0098a3;"><i class="fa fa-thumb-tack"></i> Schedule<hr style="padding:0px; margin:0px;"><i class="fa fa-calendar"></i> Solved Date</td>
                            <td style="padding:5px; width: 20px">:</td>
                            <td style="padding:5px; min-width: 160px"><span id="schedule"></span><hr style="padding:0px; margin:0px;"><span id="sol_date"></span></td>
                        </tr>

                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                <!--                <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>-->
            </div>
        </div>

    </div>
</div>

<script>

    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                //right: 'month,basicWeek,basicDay'
                right: 'month,agendaWeek,agendaDay'
            },
            eventSources: [{
                    navLinks: false,
                    editable: false,
                    eventLimit: false,
                    events: <?php echo $jsona ?>,
                    color: 'yellow',
                    textColor: 'green'
                }
            ],
            defaultDate: '<?php echo date("Y-m-d") ?>',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo $json ?>,
            eventMouseover: function (data, event, view) {
                var tooltip = '<div class="tooltiptopicevent tooltip tooltip-inner" style="width:auto;height:auto;position:absolute;z-index:10001;">' + (data.url_ == 'noul' ? '' : data.times_ + ' ' + (data.jam > 12 ? 'PM' : 'AM') ) + ' ' + data.title + '</div>';
                $("body").append(tooltip);
                $(this).mouseover(function (e) {
                    $(this).css('z-index', 10000);
                    $('.tooltiptopicevent').fadeIn('500');
                    $('.tooltiptopicevent').fadeTo('10', 1.9);
                }).mousemove(function (e) {
                    $('.tooltiptopicevent').css('top', e.pageY + 10);
                    $('.tooltiptopicevent').css('left', e.pageX + 20);
                });
            },
            eventMouseout: function (data, event, view) {
                $(this).css('z-index', 8);
                $('.tooltiptopicevent').remove();
            },
            eventClick: function (event, jsEvent, view) {
                $('#modalTitle').html('Events Maintenance');
                $('#date').html(event.date);
                $('#complaint').html(event.complaint);
                $('#typee').html(event.typee);
                $('#sourcee').html(event.sourcee);
                $('#solve').html(event.solve);
                $('#notee').html(event.notee);
                $('#sol_desc').html(event.sol_desc);
                $('#schedule').html(event.schedule);
                $('#sol_date').html(event.sol_date);
                $('#solve_prog').html(event.solve_prog);
                $('#users').html(event.users);
                $('#proj_prod').html(event.proj_prod);
                $('#proses').html(event.proses);
                $('#modalBody').html(event.description);
//            $('#eventUrl').attr('href',event.url);
                event.solve_prog == '-' ? $(".modal-dialog").attr('style', 'width:600px') : $(".modal-dialog").attr('style', 'width:900px');
                event.url_ == 'noul' ? $('#fullCalModal').modal('hide') : $('#fullCalModal').modal();
            }
        });
    });
</script>