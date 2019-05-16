describe('eventAllow', function() {
	var options;

	beforeEach(function() {
		options = {
			now: '2016-09-04',
			defaultView: 'agendaWeek',
			scrollTime: '00:00',
			editable: true,
			events: [
				{
					title: 'event 1',
					start: '2016-09-04T01:00'
				}
			]
		};
		affix('#cal');
	});

	it('disallows dragging when returning false', function(done) { // and given correct params
		options.eventAllow = function(dropInfo, event) {
			expect(typeof dropInfo).toBe('object');
			expect(moment.isMoment(dropInfo.start)).toBe(true);
			expect(moment.isMoment(dropInfo.end)).toBe(true);
			expect(typeof event).toBe('object');
			expect(event.title).toBe('event 1');
			return false;
		};
		spyOn(options, 'eventAllow').and.callThrough();

		$('#cal').fullCalendar(options);

		dragTimeGridEvent($('.fc-event'), '2016-09-04T03:00:00')
			.then(function(modifiedEvent) {
				expect(modifiedEvent).toBeFalsy(); // drop failure?
				expect(options.eventAllow).toHaveBeenCalled();
				done();
			});
	});

	it('allows dragging when returning true', function(done) {
		options.eventAllow = function(dropInfo, event) {
			return true;
		};
		spyOn(options, 'eventAllow').and.callThrough();

		$('#cal').fullCalendar(options);

		dragTimeGridEvent($('.fc-event'), '2016-09-04T03:00:00')
			.then(function(modifiedEvent) {
				expect(modifiedEvent.start.format()).toBe('2016-09-04T03:00:00');
				expect(options.eventAllow).toHaveBeenCalled();
				done();
			});
	});
});
