
## **Database GUI System** 

The Database GUI System is a database-driven application designed to manage all of the tables in your database. It uses python's front-end and back-end design to make a GUI interface. The system enables administrators to clearly understand the database information, easily manage the table information, deal with the datas. We have functions as follows:

**How to run it?**
Step 1: Download the python and pycharm and needed python libraries.
Step 2: Open Source code in the pycharm. Run the sql_flask.py.
Step 3: Go to web input "http://127.0.0.1:5000", and you can see the front page.

**How to use it?**

1. Show table function for 13 tables: You need to enter the table name in the provided input field, and then click the submit button, then it will show the table information.
2. Insert One function for the table: You need to enter the required data to be inserted into the database in the provided input field, and then click the submit button to add the new data to the database.
3. Batch Insert function for the table: You need to enter a batch of data that conforms to a table structure format in the provided input field, and then click the submit button to add the all datas to the database.
3. Delete function for each rows: You need to select the deleted data row and click the delete button to delete the data from the database.
4. Modify function for the table informations: You need enter the required data to modify, and then click the submit button, which will modify the data in the database.


**5 Functions**

1. Show table 
   + name: show_info 
   + purpose: Based on the input table name, the specific table information is displayed.  
   + usage: To run this Show table, we input the table name, then we get the whole table information in short time through interface. 
2. Insert One
   + name: insert
   + purpose: Will be inserted into the database based on the information entered by the user. 
   + usage: To run this insert, we input the information that according to the table structure, then we insert the data to database in short time through interface. 
3. Batch Insert 
   + name: batch_insert 
   + purpose: Several pieces of data provided by the user are processed and inserted into the database. 
   + usage: To run this batch_insert, we input the information that according to the table structure, then we deal with the Line breaks and Spaces, then insert all datas to database in short time through interface.                 
4. Delete  
   + name: delete 
   + purpose: Delete the selected single row.
   + usage: Select the row you want to delete, then click Delete, and it will be deleted from the database.
5. Modify 
   + name: update 
   + purpose: According to the user input new data information to update the database corresponding to the old information. 
   + usage: To use this update, you can input the new data you want, and it will update the data for the corresponding id. 
