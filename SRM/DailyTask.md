 :spiral_calendar: 27/ 01/ 2021
 ---------
 - Took public_html from server
 - configure at local
 - mysql_connect method deprecated 
 - Ask Himani Mam about how to add a new category
 - Try to insert a new Category but failed due to insert privileged in not assigned in category table
 - Created database Srm at local
 - Created tbl_login with all the fields as in MSSQL SRM database.
 - for the service table write down all 40 fields to notebook.Need to ask which are necessary.
 - Ravindra Sir changed the password of control panel.No acess to Cpanel now.
 - UI of login page and connection to db
 - Route to dashboard.

 :spiral_calendar: 28/ 01/2021
 -----------
 - Sliding nav bar in SRM dashboard
 
 :spiral_calendar: 29/ 01/ 2021
 -----------

- Add and remove textboxes on button click
- Created tabs and make them working
- alignment of text boxes
  
  :spiral_calendar: 30/ 01/ 2021
  -----------
  - Push SRM to git
  - Remark and MyComplains tab
  - Shapshot (choose file) 
  
    :spiral_calendar: 31/ 01/ 2021
    -----------
    Sunday
    
  :spiral_calendar: 1/ 01/ 2021
  -----------
   - Auto fill currrent date
   - Remove Page Id
   - Change all date fields to Date type
   - Change all warranty type to dropdown(ask vishnu sir about options)
   -Discussion with Vishnu Sir.
   
   :spiral_calendar: 2/ 01/ 2021
   -----------
   - Completed table in database
   - Implemented query to put values in database.
   - Changes names of tabs
   - Implemented table 
   - snapshot as blob datatype
   - Looked on customers table
   
   
select * from tbl_AccountMaster ac 
left outer join tbl_ACDetail_Address ad on ad.nACMasterID_UniqueID=ac.nAccount_UniqueID and ad.Is_Available=1
left outer join tbl_ACMasterDetailContactDetails details on details.nACDetailID=ad.nACDetailID and details.Is_Available=1
where ac.Is_Available=1

  :spiral_calendar: 3/ 01/ 2021
   -----------
   - make date field read only.
   - Snapshot file size alert
   - UI of SRM
   - Change names of tabs
   - Implemented Datatable
   
   :spiral_calendar: 4/ 01/ 2021
   -----------
   - pyrotechlighting.com table issue with ganshyam sir
   - Prepare query 
   - customers with null gst number and pan no exists
   - Created methods for connection to MSSQL db
   - Started creating a page as customer .
       
select ac.cACName,ad.cAddress,ad.cGSTNo,ad.cPanNo,details.cPersonName,ad.cContactNo,ad.cEmailID from tbl_AccountMaster ac 
left outer join tbl_ACDetail_Address ad on ad.nACMasterID_UniqueID=ac.nAccount_UniqueID and ad.Is_Available=1
left outer join tbl_ACMasterDetailContactDetails details on details.nACDetailID=ad.nACDetailID and details.nACContactUniqueID=ac.nAccount_UniqueID and details.Is_Available=1
where ac.Is_Available=1 and ac.nACTypeID=18 and ad.cGSTNo<>'' and ad.cPanNo<>'' 
  
   :spiral_calendar: 5/ 01/ 2021
   -----------      
   - Created tbl_customer in database.
   - Write down code for duplicacy checking
   - Write down code for inserting data from MSSQL to my SQL
   - the GST number may be same in two rows
   - figure out the problem why 3152 rows in sql and 2440 in mysql.
    
   :spiral_calendar: 6/ 01/ 2021
   -----------   
    Aria engine is not enabled or did not start. 
    The Aria engine must be enabled to continue as mysqld was configured with --with-aria-tmp-tables 2021-02-06 11:21:21 7860 [ERROR] Aborting
    
  - To fix this error remove  the file aria_log.00000001 from location C:\xampp\mysql\data\
  - Create Service Layer class and method getMaximunId for ninternal_id from database for tbl_customer 
  - Add a column as ninternal_id in DB
  - Create dropdown and username password textbox on customer page
  - Write down code for inserting ninternal id as well on inserting customers data
  - Export database
  - Push to Git all the three projects
  - 
                             
 // take internal id from MSSQL table 
 ASSign
 address city for concatenation
 
  :spiral_calendar: 7/ 01/ 2021
  -----------  
  - Sunday
  
  :spiral_calendar: 8/ 01/ 2021
  -----------  
  - Take nAccount_uniqueId from MSSQL table and map it to ninternal_id in mysql db 
  - concatenation of address and cust_name done
  - create two fields in tbl_customer as cusername and cpassword
  - Create a button assign and implement onClick
  - map username and password with customer internal_id
  
  :spiral_calendar: 9/ 01/ 2021
  -----------
  - Insert entry on tbl_login when assigning username and password to customer,
  - 
  :spiral_calendar: 10/ 01/ 2021
   -----------
   - Implemented view icon
   - implemented navigation to complain tab on click
   - 
   :spiral_calendar: 11/ 01/ 2021
   -----------
   - Half day
   
   :spiral_calendar: 12/ 01/ 2021
   ----------- 
   Leave
   
   :spiral_calendar: 13/ 01/ 2021
   ----------- 
   Leave
   
   :spiral_calendar: 14/ 01/ 2021
   ----------- 
   Sunday
   
   :spiral_calendar: 15/ 01/ 2021
   ----------- 
   - Issue resloved for Ganshyam Sir
   - Redirect to services page on submit
   - save snapshot in db
   - Add remarks tab field to same service
   - According to user
   - align text to cennter
   - Increase the width of grid 
    
   :spiral_calendar: 16/ 01/ 2021
   ----------- 
   - generate ticket number randomly
   - MAKE FIELD ticket no READONLY
   - hide is avaialable
   - show address of customer
   - show tool tip on hover
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
          