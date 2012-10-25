{*
Copyright 2011-2012 Nick Korbel

This file is part of phpScheduleIt.

phpScheduleIt is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

phpScheduleIt is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with phpScheduleIt.  If not, see <http://www.gnu.org/licenses/>.
*}
{include file='globalheader.tpl' cssFiles='css/calendar.css,css/jquery.qtip.min.css,scripts/css/fullcalendar.css' printCssFiles='scripts/css/fullcalendar.print.css'}

<div class="calendarHeading">

	<div style="float:left;">
		<a href="{$PrevLink}"><img src="img/arrow_large_left.png" alt="Back" /></a>
		{$MonthName} {$DisplayDate->Year()}
		<a href="{$NextLink}"><img src="img/arrow_large_right.png" alt="Forward" /></a>
	</div>

	<div style="float:right;">
		<a href="{PersonalCalendarUrl::Create($Today, CalendarTypes::Month)}" alt="Today" title="Today">{translate key=Today} {html_image src="calendar-day.png"}</a>
		<a href="{PersonalCalendarUrl::Create($Today, CalendarTypes::Week)}" alt="Week" title="Week">{translate key=Week} {html_image src="calendar-select-week.png"}</a>
	</div>

	<div class="clear">&nbsp;</div>

</div>

{include file='Calendar/mycalendar.common.tpl' view='month'}

{include file='globalfooter.tpl'}