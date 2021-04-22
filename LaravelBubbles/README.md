# LaravelOrganizer

## Motivation

Every Monday I plan my week, which means that I fill my calendar with a bunch of events and appointments. Most of the events are however repeating; 
I would meet one of the friends that I saw last week or go running, just as I did yesterday. 
Thus I was fed up to write every event explicitly and I created a reservoir of those repeating events, that I could simply drag and drop into my google calendar. 
The events are categorized, such as running and juggling would derive from Sports, "Django" and "Laravel" from Programming. 

From the event "Django" you can then derive more specific events, such as Django-Projects and so on. 
The tree structure that arises from that categorizing process I named Bubbles (categories with their individual items).

The project combines Laravel architecture with Javascript (Vanilla), Google API and d3 design.
The design is kept simple yet any suggestions or imporvements are welcome. 

## How to use it



### CRUD Methods: 

A category (seed of a bubble such as sports or programming or friends) can be rapidly created and searched in the pink form on the left side.

After that drag and drop the bubble into the brown area. 

![CRUD](Pics/CRUD.jpg?raw=true "CRUD")

You'll be forwarded to a detail view from which you can then update the categories' name, delete it or add children, such as ' running 'or ' juggling '.

![Details](Pics/Details.jpg?raw=true "Details")

### Organizer:
After bubbles have been created you can simply create a week schedule. With 'mousedown' on the bubble of interest and mouseup on the timeslot in the schedule an event is created and transfered to your google Calendar. 


![Organizer](Pics/Organizer.jpg?raw=true "Organizer")

## Essentiell challenges:


