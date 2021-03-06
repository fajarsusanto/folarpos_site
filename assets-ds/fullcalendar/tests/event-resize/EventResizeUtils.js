
var EventResizeUtils = {

	resize: function(rect0, rect1, debug) {
		var eventEl = EventRenderUtils.getSingleEl();

		eventEl.simulate('mouseover'); // so that resize handle is revealed

		var resizerEl = eventEl.find('.fc-resizer');
		var resizerRect = resizerEl[0].getBoundingClientRect();
		var resizerCenter = Geom.getRectCenter(resizerRect);

		var vector = Geom.subtractPoints(
			resizerCenter,
			Geom.getRectTopLeft(rect0)
		);
		var point1 = Geom.addPoints(
			Geom.getRectTopLeft(rect1),
			vector
		);
		var deferred = $.Deferred();

		resizerEl.simulate('drag', {
			point: resizerCenter,
			end: point1,
			debug: debug
		});

		currentCalendar.on('eventResizeStop', function() {
			setTimeout(function() {
				deferred.resolve({ isSuccess: false }); // won't do anything if already eventResize
			}, 20);  // will happen after eventResize's timeout
		});

		currentCalendar.on('eventResize', function(event) { // always called after eventDragStop, if success
			setTimeout(function() {
				deferred.resolve({ isSuccess: true, event: event });
			}, 10); // will happen first
		});

		return deferred.promise();
	}

};
