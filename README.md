# Project management

>news ticker
>Prog Man pic
>years tables
>ajax
>>marks category absent

project:
pid
title
stud
type
year
branch
proj co-ordin
abstract
address
guide
cid

register page:
reg course>den create project

home:
display registered courses>marks-projects etc

//////fac//////////
home:
courses>projects>by year>
view, post>marks for projects

SELECT * FROM `course` where year={$year}, c_id != (SELECT c_id FROM `register` where stud_id='{$_SESSION['user_id']}')

