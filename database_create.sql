
#apache server running mysql server and php 

CREATE TABLE users
(
User_id varchar(250),
email VARCHAR(70), 
user_name VARCHAR(250),
child bit(1),
active bit(1), 
Start_time  datetime DEFAULT NULL, 
End_time datetime DEFAULT NULL,
Last_visit datetime,
Num_visit int(10),
Email_sent bit(1)
);


CREATE TABLE EXHIBITS
(
User_id varchar(250),
SC_IN bit(1),
NAV_IN bit(1),
SP_IN bit(1),
N_IN bit(1),
QUIZ_SCORE int(10),
Done_quiz bit(1)
);


#Create user

INSERT INTO `users`(
  `User_id`, 
  `email`, 
  `user_name`, 
  `child`, 
  `active`, 
  `Start_time`, 
  `End_time`, 
  `Last_visit`, 
  `Num_visit`) 
 VALUES (
   REPLACE((UUID()),'-',''),
   "user@gmail.com",
   "user_name_example",1,1,NOW(),NOW()+(Interval 1 day),NOW(),2)


INSERT INTO `exhibits`(`User_id`, `SC_IN`, `NAV_IN`, `SP_IN`, `N_IN`, `QUIZ_SCORE`) 
VALUES ((select User_id from users where email like ‘user@gmail.com’),0,0,0,0,0)


#login to kyosk

######Ship Construction login


UPDATE `hivedata.exhibits` SET `SC_IN`=1 
WHERE user_id = ‘username’


######Navigation login


UPDATE `hivedata.exhibits` SET `NAV_IN`=1 
WHERE user_id = ‘username’


#####Nutrition login


UPDATE `hivedata.exhibits` SET `N_IN`=1 
WHERE user_id = ‘username’

#After Quiz done


UPDATE `exhibits` SET `QUIZ_SCORE`= /*  mark */ ,`done_quiz`= 1 WHERE `User_id`= user_id


UPDATE `users` SET `End_time`= NOW(),`Last_visit`= NOW(),`Num_visit`= `Num_visit` + 1 
WHERE `User_id`=[value-1]