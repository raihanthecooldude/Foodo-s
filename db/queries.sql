select * from restaurant, food where restaurant.rid = food.rid and food.category LIKE '%$food%' and food.price <= '$price'

select * from restaurant, food, restaurant_by_area, area where restaurant_by_area.AID = area.AID and restaurant_by_area.RID = restaurant.RID and restaurant.RID = food.RID and food.category like '%$food%' and price <= '$price' and area.area_name = '$area'