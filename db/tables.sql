--Restaurant-------------------------------------

create table restaurant (rid number(10) primary key, restaurant_name varchar(100), address varchar(200), restaurant_link varchar(200));
commit ;

create or replace procedure insert_into_restaurant(r_id restaurant.rid%TYPE, r_name restaurant.restaurant_name%TYPE, addr restaurant.address%TYPE, r_link restaurant.restaurant_link%TYPE)
is
  begin
    insert into restaurant (rid, restaurant_name, address, restaurant_link) values (r_id, r_name, addr, r_link);
    commit ;
  end;
commit ;


--Food----------------------------------------------

create table food (fid number(10) primary key, food_name varchar(100), price number(5), category varchar(50), rid number(10));
commit ;


create or replace procedure insert_into_food(f_id food.fid%type, f_name food.food_name%type, f_price food.price%type, f_cat food.category%type, r_id restaurant.rid%type)
is
  begin
    insert into food (fid, food_name, price, category, rid) values (f_id, f_name, f_price, f_cat, r_id);
    commit ;
  end;
commit ;


--area----------------------------------------------

create table area (aid number(10) primary key, area_name varchar(100), area_link varchar(200));
commit ;


create or replace procedure insert_into_area(a_id area.aid%type, a_name area.area_name%type, a_link area.area_link%type)
is
  begin
    insert into area (aid, area_name, area_link) values (a_id, a_name, a_link);
    commit ;
  end;
commit ;


--restaurant_by_area-----------------------------------

create table restaurant_by_area (ra_aid number(10), ra_rid number(10));
commit ;

create or replace procedure insert_into_restaurant_by_area(aid restaurant_by_area.ra_aid%type, rid restaurant_by_area.ra_rid%type)
is
  begin
    insert into restaurant_by_area (ra_aid, ra_rid) values (aid, rid);
    commit ;
  end;
commit ;