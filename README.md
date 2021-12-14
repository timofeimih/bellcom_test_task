-- Here is an information about this task: --

I did use mysql because it is often used with php.
Mysql table description and data insert queries are in "./db_data/meetings.sql"

Setting for mysql database connection are in "./get_meeting_data.php" script

"./index.html" file is used to store representation data for user.

To optimise search was used PRIMARY INDEX "id" field and UNIQUE INDEX for "meeting_id" field in "meetings_paths" table which contains xml path and coresponding meeting_id. Metting id is used because it is much faster to look on indexed UNIQUE field rather than VARCHAR type field which was used in 'path' column.

Xml files stored in './xml_paths/' for future addition of new files.

For the PHP security was used "Meekro database" library to secure mysql requests which is available in "./library/db.class.php". It was chosen because it is widely used and have proven security level after many years of use. Other than that there is check that only number is being sended to script, if not then return "Wrong request or empty meeting number". 
If number for meeting agenda is not in database then script return "There is no meeting with such number".




Thank you for your time. Any questions?
