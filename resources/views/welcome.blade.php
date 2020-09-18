<x-app>
    <main>
            <nav class="custom-nav text-center">
                <div class="container">
                    <a class="brand" href="/">Zurri Booking API Documentation</a>
                </div>
            </nav>

            <section class="content">
                <div class="row">
                    <div class="col-md-8">
                        <h1>Introduction</h1>
                        <p>In this documentation, you will find guidance on how to use the zurri booking api.</p>
                        <div class="api-section">
                            <h3>Authentication</h3>
                        <p >The api is protected for every request made with a token that is provided when a user registers and logs in. The token is then immediately revoked when the user logs out.</p>
                        <p>This api token has to be provided for every request made to the application, the only exceptions being the <code>/register</code>,  <code>/login</code> and <code>/</code> endpoints.</p>
                        <p>The api token is passed as a <code>Bearer Token</code> in the headers. Details on how to can be read <a href="https://stackoverflow.com/questions/40988238/sending-the-bearer-token-with-axios" class="link">here ( the first answer)</a></p>
                        <h4>1. Registration</h4>

<pre>
<code>
    url: https://zurri-booking.herokuapp.com/api/auth/register
    method: POST
    form params: "name", "email" and "password"
</code>
</pre>
<p>Response</p>
<pre>
    <code>
    {
        "sucess": true,
        "data": {
            "user": {
                "name": "users name",
                "email": "users email"
            },
            "message": "success message",
            "token": "api-token"
        }
    }
</code>
</pre>
<p>So the api token will be picked from there to be used in the subsequent requests.</p>
<h4>2. Login</h4>
<pre>
<code>
    url: https://zurri-booking.herokuapp.com/api/auth/login
    method: POST
    form params: "email" and "password"
</code>
</pre>
<p>It has the same response as the register endpoint</p>
</div>
<hr>
<h3>Hotels API</h3>
<p>We are going to use this Api while listing all hotels, get a single hotel, add a hotel and also delete a hotel</p>
<h4>1. Create a hotel </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels/
method: POST
Form param:"hotel_name", "description", "average_price", "district", "email", "address", "contact", "web", "number_of_rooms"
Optional params: "web", "number_of_rooms"

</code>
</pre>
<p>Response</p>
<pre>
<code>
   {
    "success": true,
    "data": {
        "message": "hotel successfully deleted",
        "hotel": {
            "id": "id",
            "hotel_name": "hotel_name",
            "description": "description",
            "price": "price",
            "district": "district",
            "email": "email",
            "average_price": "Average price for a room in the hotel",
            "district": "district",
            "email": "email",
            "web": "web address",
            "number_of_rooms": "Total number of rooms in the hotel",
            "address": "address",
            "contact": "contact",
            "created_at": "created_at",
            "updated_at": "updated_at"
        }
    }
}
</code>
</pre>
</pre>
<p>The email and contact are not required fields, but the rest are required</p>
<h4>2. Show all hotels</h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels
method: GET
param:
</code>
</pre>
<p>Response</p>
<pre>
<code>
        {
"success": true,
"data": {
    "hotels": [
        {
            "id": "hotel_id",
            "hotel_name": "hotel name",
            "description": "hotel description",

            "price": "price",
            "district": "district",
            "email": "email",

            "average_price": "Average price for a room in the hotel",
            "district": "district",
            "email": "email",
            "web": "web address",
            "number_of_rooms": "Total number of rooms in the hotel",
            "address": "address",
            "contact": "contact",
            "created_at": "created_at",
            "updated_at": "updated_at"
        },

         "count": "number of hotels"
]
}
</pre>
</code>
</pre>
<h4>3.Show a single hotel </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels/{id}
method: GET
param:id
</code>
</pre>
<p>Response</p>
<pre>
<code>
    {
    "success": true,
    "data": {
        "id": 7,
        "hotel_name": "hotel_name",
        "description": "description",
        "price":  "price",
        "district": "district",
        "email": "email",
        "average_price": "Average price for a room in the hotel",
        "district": "district",
        "email": "email",
        "web": "web address",
        "number_of_rooms": "Total number of rooms in the hotel",

        "address": "address",
        "contact": "contact",
        "created_at": "created_at",
        "updated_at": "updated_at"
    }
}
</code>
</pre>
<h4>4.Update  a single hotel </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels/{id}
method: PUT
param:id
</code>
</pre>
<p>Response</p>
<pre>
<code>
   {
    "success": true,
    "data": {
        "message": "hotel updated successfully",
        "hotel": {
            "id": 7,
            "hotel_name": "hotel_name",
            "description": "description",
            "price": "price",
            "district": "district",
            "email": "email",
            "average_price": "Average price for a room in the hotel",
            "district": "district",
            "email": "email",
            "web": "web address",
            "number_of_rooms": "Total number of rooms in the hotel",
            "address": "address",
            "contact": "contact",
            "created_at": "created_at",
            "updated_at": "updated_at"
        }
    }
}
</code>
</pre>
<h4>5.Delete  a single hotel </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels/{id}
method: DELETE
param:id
</code>
</pre>
<p>Response</p>
<pre>
<code>
   {
    "success": true,
    "data": {
        "message": "hotel successfully deleted",
        "hotel": {
            "id": "id",
            "hotel_name": "hotel_name",
            "description": "description",
            "price": "price",
            "district": "district",
            "email": "email",
            "average_price": "Average price for a room in the hotel",
            "district": "district",
            "email": "email",
            "web": "web address",
            "number_of_rooms": "Total number of rooms in the hotel",
            "address": "address",
            "contact": "contact",
            "created_at": "created_at",
            "updated_at": "updated_at"
        }
    }
}
</code>
</pre>
<hr>
<h3>Rooms API</h3>
<p>We are going to use this Api while listing all Rooms, get a single room, add a room and also delete a room</p>
<h4>6.Get all Rooms </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/rooms/
method: GET
</code>
</pre>
<p>Response</p>
<pre>
<code>
  {
    "success": true,
    "data": {
        "rooms": [
            {
                "id": "id",
                "hotel_id": "hotel_id",
                "name": "roomname",
                "description": "description",
                "minimum_stay_night": "minimum_stay_night",
                "price": "price",
                "max_number_of_guests": "max_number_of_guests",
                "created_at": "created_at",
                "updated_at": "updated_at"
            },
        ],
        "count": "totalrooms"
    }
}
</code>
</pre>
<h4>7.Get  a single Room </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/rooms/{id}
method: GET
param:id
</code>
</pre>
<p>Response</p>
<pre>
<code>
  {
    "success": true,
    "data": {
        "rooms":
            {
                "id": "id",
                "hotel_id": "hotel_id",
                "name": "roomname",
                "description": "description",
                "minimum_stay_night": "minimum_stay_night",
                "price": "price",
                "max_number_of_guests": "max_number_of_guests",
                "created_at": "created_at",
                "updated_at": "updated_at"
            }
    }
}
</code>
</pre>
<h4>8.Add a single Room </h4>
<p>Here we have used a one to many relationship where by we shall be adding a room to a particular hotel, the room will pick the hotel_id while adding it  </p>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels/room/{hotel_id}
method: POST
param: hotel_id
</code>
</pre>
<p>Response</p>
<pre>
<code>
  {
    "success": true,
    "data": {
        "message": "room added successfully",
        "room": {
            "hotel_id": "hotel_id",
            "name": "name",
            "description":  "description",
            "price": "price",
            "minimum_stay_night": "minimum_stay_night",
            "max_number_of_guests": "max_number_of_guests",
            "updated_at":  "updated_at",
            "created_at": "created_at",
            "id": "room_id"
        }
    }
}


</code>
</pre>
<h4>9. Update single Room </h4>
<p>We have used a one to many relationship where by we shall be updating a room to a particular hotel, the room will pick the hotel_id while updating it  </p>
<p> </p>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/hotels/room/{hotel_id}
method: PUT
param: hotel_id
</code>
</pre>
<p>Response</p>
<pre>
<code>
  {
    "success": true,
    "data": {
        "message": "Room updated successfully",
        "room": {
            "hotel_id": "hotel_id",
            "name": "name",
            "description":  "description",
            "price": "price",
            "minimum_stay_night": "minimum_stay_night",
            "max_number_of_guests": "max_number_of_guests",
            "updated_at":  "updated_at",
            "created_at": "created_at",
            "id": "room_id"
        }
    }
}
</code>
</pre>
<h4>10.Delete single Room </h4>
<pre>
<code>
url: https://zurri-booking.herokuapp.com/api/rooms/{id}
method: DELETE
param: room_id
</code>
</pre>
<p>Response</p>
<pre>
<code>
  {
    "success": true,
    "data": {
        "message": "Room successfully deleted",
        "room": {
            "id": "id",
            "hotel_id": "hotel_id",
            "name": "name",
            "description":  "description",
            "price": "price",
            "minimum_stay_night": "minimum_stay_night",
            "max_number_of_guests": "max_number_of_guests",
            "created_at": "created_at",
            "updated_at":  "updated_at",
        }
    }
}
</code>
</pre>
</div>
</div>
</section>
 </main>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.3/highlight.min.js" integrity="sha512-tHQeqtcNWlZtEh8As/4MmZ5qpy0wj04svWFK7MIzLmUVIzaHXS8eod9OmHxyBL1UET5Rchvw7Ih4ZDv5JojZww==" crossorigin="anonymous"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</html>
</x-app>

