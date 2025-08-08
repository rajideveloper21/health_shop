CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    cell_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE fruits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT
    image VARCHAR(255) NOT NULL, -- Path to the uploaded image

);

CREATE TABLE herbs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT
    image VARCHAR(255) NOT NULL, -- Path to the uploaded image


);

CREATE TABLE hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL, -- Path to the uploaded image
    description TEXT NOT NULL,
    best_treatment VARCHAR(100) NOT NULL,
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_type ENUM('fruit', 'herb') NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);




/health-shop
│
├── /admin
│   ├── add_fruit.php          # Admin page to add new fruits
│   ├── add_herb.php           # Admin page to add new herbs
│   ├── add_hospital.php       # Admin page to add new hospitals
│   ├── view_orders.php         # Admin page to view all orders
│   ├── view_fruits.php         # Admin page to view all fruits
│   ├── view_herbs.php          # Admin page to view all herbs
│   ├── view_hospitals.php      # Admin page to view all hospitals
│   └── admin_dashboard.php      # Admin dashboard overview
│
├── /user
│   ├── view_fruits.php         # User page to view available fruits
│   ├── view_herbs.php          # User page to view available herbs
│   ├── orders.php         # User page to view add to card click fruits and herbs
│   ├── view_orders.php     #user page to view the orders
│   └── search_hospital.php      # User page to search for hospitals
│
├── /includes
│   ├── db.php                  # Database connection file
│   ├── functions.php           # Utility functions (e.g., for validation)
│   ├── header.php              # Common header for user pages
│   └── admin_header.php        # Common header for admin pages
│
├── /uploads                    # Directory for uploaded images (fruits, herbs, hospitals)
│
├── /css
│   └── styles.css              # CSS styles for the application
│
├── index.php 
├── login.php 
├── register.php                   # Main entry point of the application
│
└── logout.php                  # Logout functionality



	Here are 25 fruits in English: 
Apple, Banana, Orange, Mango, Grapes, 
Watermelon, Pineapple, Strawberry, Kiwi, 
Papaya, Pomegranate, Peach, Plum, Pear, 
Apricot, Cherry, Lemon, Lime, Coconut, Avocado, 
Blackberries, Blueberries, Raspberries, Figs, and Durian.

	Here are 25 Herbs in English: 
Basil, Mint, Thyme, Oregano, Sage, Rosemary,Parsley, Cilantro, 
Chives, Dill,Chervil,Bay Leaf,Lemongrass,Peppermint,
Chamomile, Lavender, Hyssop, Plantain, Holy Basil (Tulsi),
Angelica, Anise, Asafoetida, Black Cumin, Kasuri Methi, Gali. 

	Here are 25 hospital in English:
Apollo Hospital, Fortis Malar Hospital, MIOT International, Shri Ramachandra Medical Centre,
Christian Medical College, Kauvery Hospital, Billroth Hospitals, PSG Hospitals, G. Kuppuswamy Naidu Memorial 
(GKNM) Hospital,  Vijaya Hospital, AR Hospital, A.G. Eye Hospital, Aishwaryam Specialty Hospital,
Sri Narayani Hospital & Research Centre, Adiparasakthi Hospital, KMCH Speciality Hospital,
AKA Hospital, VVR Hospital, AVM Hospitals, Sugam Hospital, 
Dharan Hospital, Ayesha Hospital, Deepan Hospital, Ganga Hospital,
Velammal Hospital,Arun Hospital, preethi hospital, Vega ENT Hospital



