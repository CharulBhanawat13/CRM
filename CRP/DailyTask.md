13/10/2020
---

 - Xampp port issue resolved
 - First file must be index.php
 - Project Location: C/xampp/htdocs/CRP
 - Created a dash board
 - looked at routing .
 - Xampp password: test@123 => mysql.ini
 - Database name: crp
 - Project Structure
 - marquee



14/10/2020
---

Created a new file
db_connection.php  ------  open Connecction();
-----------------------------------close Connection();

Created the following table as “tbl_employeeMaster”

Header Name
Column Name
DataType
Engineer name
cengineer_name
varchar
Address
caddress
varchar
City
ccity
varchar
State
cstate
varchar
Country
ccountry
varchar
Mobile Nmber
cmobile_number
varchar
Email Id
cemail_id
varchar
Key A/c Manager
ckey_ac_manager
varchar
Created Date
dcreated_date
datetime
Updated Date
dupdated_date
datetime
EngineerId
nengineer_id
int
isAvailable
isAvailable
bit
isActive
isActive
bit

Insert few entries in Table Manually

Code to fetch data from table and display in form of table

Apply CSS to table


INSERT INTO `tbl_employeemaster`
(`cengineer_name`, `ccity`, `cstate`, `ccountry`, `ckey_ac_manager`,`caddress`, `cmobile_number`, `cemail_id`, `isAvailable`,
`isActive`,`dcreated_date`, `dupdated_date`) VALUES
('Harry','Nepal','Rajasthan','Hiroshima','Jing Ping','Nagaskai','987654567','harry@gmail.com',1,1,2020-12-12,2020-09-09)

Xampp install on another machine
Backup

15/10/2020
----------

using onClick is a poor programming practice
https://stackoverflow.com/questions/17378199/uncaught-referenceerror-function-is-not-defined-with-onclick

Modal to another page-Stucked
model.content on same page
save
close
html
css
created modal from same page
create modaL in another file
Refresh icon

17/10/2020
---
- study about php
- create dropdowns for Country,State,City
- create table countries
- create table states
- create table cities
- call ajax in jquery to fetch data from db and reflect in UI- fetched from db,write down queries
- issue regarding on changing state => uodation of city
 Vaidation
- name
- mobile number to maximum length 10
- Drop down of key ac manager
- ETA
- 
20/10/2020
---

- corrected city,state,coutry dropdowns
- Added Alternate mobile number field ,insert  to database.
- Database varchar to 50 all fields except address.
- Validation of maxLength to 50 to input text
- Validation to select all fields
- Study about filters



21/10/2020
----------

 - Implemented Data Tables
 - Searching within data table
- Sorting within data table
- P rev next button
- Page size
- msg of filtered result
- Advance Search on any data
- UI Alignment----- Pending
- key acount manager on basis of user type

22/10/2020
----------

- install git
- pushed code to git
- changed folder structure
- pushed to git
- database mistmatch during import instead of export
- recover database
- Reset form
- open same modal for updation
- delete icon
remove the search box from delete

23/10/2020
----------

- added username and password in db
- insert into db
- Created login page
- implemented css and work on UI
- Created logout page
- try to access dashboard page without login
- pushed code to master with db

24/10/2020- official holiday
---
25/10/2020-sunday
---


26/10/2020
----------

- Check if the username already exist in databse.do not insert duplicate.
- how to debug in php in notepad
- fetch which user has logged in
- fetch usertype of logged in user

27/10/2020
----------

- Download Visual Studio
- Can management or manger can add new employee
- Delete functionality
- Employee table according to user type
- try debugging in note++
- try debugging in VS code
- 
28/10/2020
---
- Insert entries in database
- put edit icon on table
- Remove the search bar fron edit icon
- Internet not working
- Remone Title " Add NEw Employee"

31/10/2020
---
- 9: 30-10:15---------- Net not working
- 10:47-11:55---------  Net not working
- Created segment table
- Created segment page
- edit functinality-  show values in edit modal
- Implemented select query for segment table
- 4:25 - 5:30 ------Net not working
- Insert few entries
- Implemented Home icon on employeeDetails Page



3/11/2020
---
- 9:46-net not working
- 10:09 -net not working
- set isAvailbale in query
- clickable function working for only first page
- https://stackoverflow.com/questions/39992190/clickable-row-only-works-on-the-first-page-in-datatable
- open same modal on addition and updation
- merging the code of save and update.
- 
4/11/2020
---------

- Use same modal on save and update
- push code
- show values all drop down values while update
- Remove errors (reset,alternate mobile number,reset dropdown)
- Implemented filters on segment table
- Implemented Modal on Segment Page

5/11/2020
----
- Resolve the issue of key_ac_manager_id setting 0
- Created Organisation Table
- Fetch Data from table and Display Table Ui
- Implemented Datatable and Filters
- Created Modal on Update
- Implemented City-State-Country Dropdown
- Fill data in modal
- Implement Update query
- Remove duplicate options from dropdown

6/11/2020
---
- delete on organisation page
- change nid to norg_id in update also
- Created table for contact person in database
- started working on Contact Person Page

10/11/2020
---
- Show department dropdown
- Create department table
- insert an entry into department table
- show dept name in Data-table
- created table for call list in db
- Insert an entry in al list
- SHoe datable for call list
- implemented date dropdown in modal

11/11/2020
---
Holiday(Leave)

12/11/2020
---
- Worked on "Filters" on Call List Page that was not working earlier.
- Change datatype of brieftalk to "text" in Database i.e best suitable for memofield(as discussed with Sir) can hold upto 65534 characters.
- Change input type of briefTalk to textarea in code for input field.
- Created a new  table "tbl_purpose" in database and insert few entries.
- Display name of Organisation and Purpose name instead of ID in datatable of Call List
- Implemented a dropdown to get Persons from Contact person table(as discussed).
- worked on Oraganisation and purpose dropdown in call list modal
- Implemented Call List Update Query.
- Having issue with date field (date fields not setting vales for update)- Pending
- Implemented Add Query
- Implemented Delete Query
- Need to correct the Logic of nid and otherId on all pages
Pending on Call List
Date Filters and user permissions

13/11/2020
---
- Working on Date Filters
- Implemented two date-picker dropdown on callList Page asStart Date and End Date
- Create a new PHP Class as Date Filters and created a function as prepare Query.
- Engaged in Rangoli making and diwali celebration

14/11/2020
---
Diwali HolidY
15/11/2020
---
Diwali HolidY
16/11/2020
---
Diwali HolidY

17/11/2020
---
- Date Filter with start date end date working.
- Reset button working
- On Page refresh with F5 working
- Push code to git
- Set date field values on update modal
- Show (Corrected)an alert if username already exist.
- Corrected query for already taken username
- wORKING ON DUPLICTE EMPLOYEE CODE

18/11/2020
---
Create a checkbox.
implemented checkbox functionality
Added a column internal_id in all tables in database
try adding functionality of duplicacy of employee code but it need stored proc feature first
Implement visit-plan page with call list table
Implemented a test page to test stored proc
working on stored proc returning value
use dtored proc on page and get result ferom code
push code

19/11/2020 - 26/11/2020
---
on leave

27/11/2020
---
Execute stored proc to insert value in internal id.Make it working
Change critera for
Update, delete and add in organisation
Update, delete and add in contact person
update delete and add in call list
update ,delete and add in employeemaster
Changes in UI for hidden fields
Created table tbl_visitplan in database
Pending : search box draw on delete and update
PHP Storm evaluation will expire

28/11/2020
---
Check the visit plan page update delete and add.
make dropdown in modal for organisation in visit plan and populate data from organisation table.
make dropdown for person to meet and populate data according to organisation selected
Created purpose dropdown and populate data from tbl_purpose
Checked date filters working
Show name instead if id in datatable
Fix issue regarding entry in employee page
Fix few errors in visit plan

Pending: Reset icon fu 13/10/2020
---

 - Xampp port issue resolved
 - First file must be index.php
 - Project Location: C/xampp/htdocs/CRP
 - Created a dash board
 - looked at routing .
 - Xampp password: test@123 => mysql.ini
 - Database name: crp
 - Project Structure
 - marquee



14/10/2020
---

Created a new file
db_connection.php  ------  open Connecction();
-----------------------------------close Connection();

Created the following table as “tbl_employeeMaster”

Header Name
Column Name
DataType
Engineer name
cengineer_name
varchar
Address
caddress
varchar
City
ccity
varchar
State
cstate
varchar
Country
ccountry
varchar
Mobile Nmber
cmobile_number
varchar
Email Id
cemail_id
varchar
Key A/c Manager
ckey_ac_manager
varchar
Created Date
dcreated_date
datetime
Updated Date
dupdated_date
datetime
EngineerId
nengineer_id
int
isAvailable
isAvailable
bit
isActive
isActive
bit

Insert few entries in Table Manually

Code to fetch data from table and display in form of table

Apply CSS to table


INSERT INTO `tbl_employeemaster`
(`cengineer_name`, `ccity`, `cstate`, `ccountry`, `ckey_ac_manager`,`caddress`, `cmobile_number`, `cemail_id`, `isAvailable`,
`isActive`,`dcreated_date`, `dupdated_date`) VALUES
('Harry','Nepal','Rajasthan','Hiroshima','Jing Ping','Nagaskai','987654567','harry@gmail.com',1,1,2020-12-12,2020-09-09)

Xampp install on another machine
Backup

15/10/2020
----------

using onClick is a poor programming practice
https://stackoverflow.com/questions/17378199/uncaught-referenceerror-function-is-not-defined-with-onclick

Modal to another page-Stucked
model.content on same page
save
close
html
css
created modal from same page
create modaL in another file
Refresh icon

17/10/2020
---
- study about php
- create dropdowns for Country,State,City
- create table countries
- create table states
- create table cities
- call ajax in jquery to fetch data from db and reflect in UI- fetched from db,write down queries
- issue regarding on changing state => uodation of city
 Vaidation
- name
- mobile number to maximum length 10
- Drop down of key ac manager
- ETA
- 
20/10/2020
---

- corrected city,state,coutry dropdowns
- Added Alternate mobile number field ,insert  to database.
- Database varchar to 50 all fields except address.
- Validation of maxLength to 50 to input text
- Validation to select all fields
- Study about filters



21/10/2020
----------

 - Implemented Data Tables
 - Searching within data table
- Sorting within data table
- P rev next button
- Page size
- msg of filtered result
- Advance Search on any data
- UI Alignment----- Pending
- key acount manager on basis of user type

22/10/2020
----------

- install git
- pushed code to git
- changed folder structure
- pushed to git
- database mistmatch during import instead of export
- recover database
- Reset form
- open same modal for updation
- delete icon
remove the search box from delete

23/10/2020
----------

- added username and password in db
- insert into db
- Created login page
- implemented css and work on UI
- Created logout page
- try to access dashboard page without login
- pushed code to master with db

24/10/2020- official holiday
---
25/10/2020-sunday
---


26/10/2020
----------

- Check if the username already exist in databse.do not insert duplicate.
- how to debug in php in notepad
- fetch which user has logged in
- fetch usertype of logged in user

27/10/2020
----------

- Download Visual Studio
- Can management or manger can add new employee
- Delete functionality
- Employee table according to user type
- try debugging in note++
- try debugging in VS code
- 
28/10/2020
---
- Insert entries in database
- put edit icon on table
- Remove the search bar fron edit icon
- Internet not working
- Remone Title " Add NEw Employee"

31/10/2020
---
- 9: 30-10:15---------- Net not working
- 10:47-11:55---------  Net not working
- Created segment table
- Created segment page
- edit functinality-  show values in edit modal
- Implemented select query for segment table
- 4:25 - 5:30 ------Net not working
- Insert few entries
- Implemented Home icon on employeeDetails Page



3/11/2020
---
- 9:46-net not working
- 10:09 -net not working
- set isAvailbale in query
- clickable function working for only first page
- https://stackoverflow.com/questions/39992190/clickable-row-only-works-on-the-first-page-in-datatable
- open same modal on addition and updation
- merging the code of save and update.
- 
4/11/2020
---------

- Use same modal on save and update
- push code
- show values all drop down values while update
- Remove errors (reset,alternate mobile number,reset dropdown)
- Implemented filters on segment table
- Implemented Modal on Segment Page

5/11/2020
----
- Resolve the issue of key_ac_manager_id setting 0
- Created Organisation Table
- Fetch Data from table and Display Table Ui
- Implemented Datatable and Filters
- Created Modal on Update
- Implemented City-State-Country Dropdown
- Fill data in modal
- Implement Update query
- Remove duplicate options from dropdown

6/11/2020
---
- delete on organisation page
- change nid to norg_id in update also
- Created table for contact person in database
- started working on Contact Person Page

10/11/2020
---
- Show department dropdown
- Create department table
- insert an entry into department table
- show dept name in Data-table
- created table for call list in db
- Insert an entry in al list
- SHoe datable for call list
- implemented date dropdown in modal

11/11/2020
---
Holiday(Leave)

12/11/2020
---
- Worked on "Filters" on Call List Page that was not working earlier.
- Change datatype of brieftalk to "text" in Database i.e best suitable for memofield(as discussed with Sir) can hold upto 65534 characters.
- Change input type of briefTalk to textarea in code for input field.
- Created a new  table "tbl_purpose" in database and insert few entries.
- Display name of Organisation and Purpose name instead of ID in datatable of Call List
- Implemented a dropdown to get Persons from Contact person table(as discussed).
- worked on Oraganisation and purpose dropdown in call list modal
- Implemented Call List Update Query.
- Having issue with date field (date fields not setting vales for update)- Pending
- Implemented Add Query
- Implemented Delete Query
- Need to correct the Logic of nid and otherId on all pages
Pending on Call List
Date Filters and user permissions

13/11/2020
---
- Working on Date Filters
- Implemented two date-picker dropdown on callList Page asStart Date and End Date
- Create a new PHP Class as Date Filters and created a function as prepare Query.
- Engaged in Rangoli making and diwali celebration

14/11/2020
---
Diwali HolidY
15/11/2020
---
Diwali HolidY
16/11/2020
---
Diwali HolidY

17/11/2020
---
- Date Filter with start date end date working.
- Reset button working
- On Page refresh with F5 working
- Push code to git
- Set date field values on update modal
- Show (Corrected)an alert if username already exist.
- Corrected query for already taken username
- wORKING ON DUPLICTE EMPLOYEE CODE

18/11/2020
---
- Create a checkbox.
- implemented checkbox functionality
- Added a column internal_id in all tables in database
- try adding functionality of duplicacy of employee code but it need stored proc feature first
- Implement visit-plan page with call list table
- Implemented a test page to test stored proc
- working on stored proc returning value
- use dtored proc on page and get result ferom code
- push code

19/11/2020 - 26/11/2020
---
on leave

27/11/2020
---
- Execute stored proc to insert value in internal id.Make it working
- Change critera for
- Update, delete and add in organisation
- Update, delete and add in contact person
- update delete and add in call list
- update ,delete and add in employeemaster
- Changes in UI for hidden fields
- Created table tbl_visitplan in database
- Pending : search box draw on delete and update
- PHP Storm evaluation will expire

28/11/2020
---
- Check the visit plan page update delete and add.
- make dropdown in modal for organisation in visit plan and populate data from organisation table.
- make dropdown for person to meet and populate data according to organisation selected
- Created purpose dropdown and populate data from tbl_purpose
- Checked date filters working
- Show name instead if id in datatable
- Fix issue regarding entry in employee page
- Fix few errors in visit plan

Pending: Reset icon functionality
Removing options of dropdown
Permissions role(add employee_id field in tbl_visitplan first)
delete stored proc
UI implementaion
validations

1/12/2020
---
- search box column in every field
- reset functionality on every page on update and add
- added column "nlogged_in_user_id" in 4 tables tbl_callList,tbl_visitplan,tbl_tour,tbl_contactperson
 - Insert logged in user id in database  internally on all the 4 pages.
- prepare query to fetch result on call list
- Creating a new method in class ServiceLayer to implement common functionalty to fetch query in all 4 pages

 2/12/2020
 --

- PHP Storm expires
- Download VS Code but is unsupported
- Try intelliJ but requires Ultimate version
- Look at date formats .....need to insert STR_TO_DATE() before date
- cron_jobs
- jenkins


1/12/2020
---
 - search box column in every field
- reset functionality on every page on update and add
- added column "nlogged_in_user_id" in 4 tables tbl_callList,tbl_visitplan,tbl_tour,tbl_contactperson
-  Insert logged in user id in database  internally on all the 4 pages.
- prepare query to fetch result on call list
- Creating a new method in class ServiceLayer to implement common functionalty to fetch query in all 4 pages

:spiral_calendar:
 2/12/2020
 ---

PHP Storm expires
Download VS Code but is unsupported
Try intelliJ but requires Ultimate version
Look at date formats .....need to insert STR_TO_DATE() before date
cron_jobs
jenkins

:spiral_calendar:	 3/12/2020
--------------------

 - Ask Ravindra Sir for PHPStorm License
 - Try out the free version for 30 day trial again
 - Implemented the permissionRoleQuery on
1. ```Call List Page```
2. ```Visit Plan Page```
3. ```Tour Page```
 - Clear the database and insert few entries from UI.
- Test pages and permission role funtionality.
- Backup Data and commit.




