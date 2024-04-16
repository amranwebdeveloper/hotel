
    <?php $services  = []; ?>
    <div class="container">
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-md-12" style="background: white;padding: 15px;">
                <div id="dates-calendar" class="dates-calendar"></div>
            </div>
        </div>
    </div>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('libs/fullcalendar-4.2.0/core/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libs/fullcalendar-4.2.0/daygrid/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libs/daterange/daterangepicker.css')); ?>">

    <style>
        .event-name{
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
        #dates-calendar .loading{

        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('libs/daterange/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/daterange/daterangepicker.min.js?_ver='.config('app.asset_version'))); ?>"></script>
    <script src="<?php echo e(asset('libs/fullcalendar-4.2.0/core/main.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/fullcalendar-4.2.0/interaction/main.js')); ?>"></script>
    <script src="<?php echo e(asset('libs/fullcalendar-4.2.0/daygrid/main.js')); ?>"></script>

    <script>
		var calendarEl,calendar,lastId,formModal;
        $('#items_tab').on('show.bs.tab',function (e) {
			calendarEl = document.getElementById('dates-calendar');
			lastId = $(e.target).data('id');
            if(calendar){
				calendar.destroy();
            }
			calendar = new FullCalendar.Calendar(calendarEl, {
                buttonText:{
                    today:  '<?php echo e(__('Today')); ?>',
                },
                locale: bookingCore.language,
				plugins: [ 'dayGrid' ,'interaction'],
				header: {},
				selectable: true,
				selectMirror: false,
				allDay:false,
				editable: false,
				eventLimit: true,
				defaultView: 'dayGridMonth',
                firstDay: daterangepickerLocale.first_day_of_week,
				events:{
                    	url:"<?php echo e(route('hotel.frontend.layouts.details.room-availability.loadDates',['hotel_id'=>$row->id])); ?>",
						extraParams:{
							id:lastId,
                        }
                },
				loading:function (isLoading) {
					if(!isLoading){
						$(calendarEl).removeClass('loading');
					}else{
						$(calendarEl).addClass('loading');
					}
				},
				select: function(arg) {
                    formModal.show({
                        start_date:moment(arg.start).format('YYYY-MM-DD'),
                        end_date:moment(arg.end).format('YYYY-MM-DD'),
                    });
				},
                eventClick:function (info) {
					var form = Object.assign({},info.event.extendedProps);
                    form.start_date = moment(info.event.start).format('YYYY-MM-DD');
                    form.end_date = moment(info.event.start).format('YYYY-MM-DD');
                    console.log(form);
                    formModal.show(form);
                },
                eventRender: function (info) {
                    $(info.el).find('.fc-title').html(info.event.title);
                }
			});
			calendar.render();
		});

        $('.event-name:first-child a').trigger('click');

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/amraezyf/hotel.amranwebdeveloper.com/modules/Hotel/Views/frontend/layouts/details/room-availability.blade.php ENDPATH**/ ?>