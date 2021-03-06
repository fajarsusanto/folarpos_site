describe('destroy', function() {

	beforeEach(function() {
		affix('#cal');
	});

	describe('when calendar is LTR', function() {
		it('cleans up all classNames on the root element', function() {
			$('#cal').fullCalendar({
				isRTL: false
			});
			$('#cal').fullCalendar('destroy');
			expect($('#cal')[0].className).toBe('');
		});
	});

	describe('when calendar is RTL', function() {
		it('cleans up all classNames on the root element', function() {
			$('#cal').fullCalendar({
				isRTL: true
			});
			$('#cal').fullCalendar('destroy');
			expect($('#cal')[0].className).toBe('');
		});
	});

	describeOptions('theme', {
		'when jquery-ui theme': 'jquery-ui',
		'when bootstrap theme': 'bootstrap3'
	}, function() {
		it('cleans up all classNames on the root element', function() {
			initCalendar();
			$('#cal').fullCalendar('destroy');
			expect($('#cal')[0].className).toBe('');
		});
	});

	[ 'month', 'basicWeek', 'agendaWeek' ].forEach(function(viewName) {

		describe('when in ' + viewName + ' view', function() {
			var options;

			beforeEach(function() {
				options = {
					defaultView: viewName,
					defaultDate: '2014-12-01',
					droppable: true, // likely to attach document handler
					editable: true, // same
					events: [
						{ title: 'event1', start: '2014-12-01' }
					]
				};
			});

			it('leaves no handlers attached to DOM', function(done) {
				setTimeout(function() { // in case there are delayed attached handlers

					var origDocCnt = countHandlers(document);
					var origElCnt = countHandlers('#cal');

					$('#cal').fullCalendar(options);

					$('#cal').fullCalendar('destroy');
					setTimeout(function() { // might not have detached handlers synchronously

						expect(countHandlers(document)).toBe(origDocCnt);
						expect(countHandlers('#cal')).toBe(origElCnt);

						done();
					}, 100);
				}, 100);
			});

			// Issue 2432
			it('preserves existing window handlers when handleWindowResize is off', function(done) {
				var resizeHandler = function() { };
				var handlerCnt0 = countHandlers(window);
				var handlerCnt1;
				var handlerCnt2;

				$(window).on('resize', resizeHandler);
				handlerCnt1 = countHandlers(window);
				expect(handlerCnt1).toBe(handlerCnt0 + 1);

				$('#cal').fullCalendar({
					handleWindowResize: false
				});

				$('#cal').fullCalendar('destroy');
				setTimeout(function() { // might not have detached handlers synchronously

					handlerCnt2 = countHandlers(window);
					expect(handlerCnt2).toBe(handlerCnt1);

					done();
				}, 100);
			});
		});
	});

});
