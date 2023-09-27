-- query 1
insert into clients
values (default,'Tony','Stark','tony@starkent.com','Iam1ronM@n',1,'I am the real Ironman');

-- query 2
update clients
set clientLevel=3
where clientFirstname='Tony' and clientLastname='Stark';

-- query 3
update inventory
set invDescription=replace(invDescription, 'small interiors', 'spacious interior')
where invMake='GM' and invModel='Hummer';

-- query 4
select invModel, classificationName
from inventory i join carclassification c 
on i.classificationId=c.classificationId
where c.classificationName='SUV';

-- query 5
delete from inventory
where invMake='Jeep' and invModel='Wrangler';

-- query 6
UPDATE inventory
SET invImage=concat('/phpmotors',invImage), invThumbnail=concat('/phpmotors',invThumbnail);