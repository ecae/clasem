@extends('layouts.original')
@push('css')

<link rel="stylesheet" href="{{ asset('tema1/css/fullcalendar.css') }}" />

<link rel="stylesheet" href="{{ asset('tema1/css/buttons.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/fixedHeader.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/responsive.bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/scroller.bootstrap.min.css') }}" />

<link rel="shortcut icon" href="{{ asset('tema1/img/favicon_1.ico') }}">
<link rel="stylesheet" href="{{ asset('tema1/css/custombox.min.css') }}" />
<link rel="stylesheet" href="{{ asset('tema1/css/bootstrap.min.css') }}" />

@endpush
@section('content')





<!-- Page-Title -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">

            <h4 class="m-t-0 header-title"><b>Programacion de Mantenimientos </b></h4>

            <div class="row">
                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="card-box">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                                <div id="calendar"></div>
                            </div>
                        </div> <!-- end col -->
                    </div>  <!-- end row -->

                    <!-- BEGIN MODAL -->
                    <div class="modal fade none-border" id="event-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Detalle del Evento</strong></h4>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Add Category -->

                    <!-- END MODAL -->
                </div>
                <!-- end col-12 -->
            </div> <!-- end row -->
        </div>
    </div>
</div>






@endsection
@section('js')

    <script src="{{ asset('tema1/js/moment.js') }}"></script>
    <script src="{{ asset('tema1/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('tema1/js/jszip.min.js') }}"></script>
    <script src="{{ asset('tema1/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('tema1/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('tema1/js/buttons.html5.min.js') }}"></script>

@endsection
@push('scripts')
<script>

    !function($) {
        "use strict";
        var CalendarApp = function() {
            this.$body = $("body")
            this.$modal = $('#event-modal'),
                this.$event = ('#external-events div.external-event'),
                this.$calendar = $('#calendar'),
                this.$saveCategoryBtn = $('.save-category'),
                this.$categoryForm = $('#add-category form'),
                this.$extEvents = $('#external-events'),
                this.$calendarObj = null
        };
        /* on click on event */
        CalendarApp.prototype.onEventClick =  function (calEvent, jsEvent, view) {
            var $this = this;
            var token = $("#token").val();
            var form = $("<form></form>");
            form.append("<label>Mantenimiento:</label>");
            form.append("<label class='form-control' >"+calEvent.title+" </label>");
            //form.append("<input class='form-control' type=text value='" + calEvent.title + "' />");
            form.append("<br>");
            form.append("<label>Maquinaria:</label>");
            form.append("<label class='form-control' >"+calEvent.description+" </label>");
            $this.$modal.modal({
                backdrop: 'static'
            });
            $this.$modal.find('.delete-event').show().end().find('.save-event').hide().end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click').click(function () {

                $this.$modal.modal('hide');
            });

        }

        /* Initializing */
        CalendarApp.prototype.init = function() {
            var $this = this;
            $this.$calendarObj = $this.$calendar.fullCalendar({
                slotDuration: '00:15:00', /* If we want to split day time each 15minutes */
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'month',
                handleWindowResize: true,
                height: $(window).height() - 200,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'hoy',
                    month: 'mes',
                    week: 'semana',
                    day: 'dia'
                },
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
                events: { url:"cargaEvento"},
                editable: false,
                droppable: false, // this allows things to be dropped onto the calendar !!!
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); },

            });

        },
            //init CalendarApp
            $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

    }(window.jQuery),

//initializing CalendarApp
        function($) {
            "use strict";
            $.CalendarApp.init()
        }(window.jQuery);

</script>

@endpush