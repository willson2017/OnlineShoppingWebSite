create table cartitem
(
	ID int(10) unsigned auto_increment
		primary key,
	CartID varchar(500) null,
	COUNT int(10) not null,
	DateCreated date not null,
	ProductID int(10) unsigned not null
)
;

create index ProductID
	on cartitem (ProductID)
;

create table category
(
	CategoryID int(10) unsigned auto_increment
		primary key,
	CategoryName varchar(50) not null
)
;

create index category_CategoryName_index
	on category (CategoryName)
;

create table orderdetail
(
	OrderDetailID int(10) unsigned auto_increment
		primary key,
	OrdersID int(10) unsigned not null,
	ProductID int(10) unsigned not null,
	Quantity int(10) not null,
	SubTotal decimal(18,2) not null,
	UnitPrice decimal(18,2) not null
)
;

create index orderdetail_Quantity_index
	on orderdetail (Quantity)
;

create index orderdetail_SubTotal_index
	on orderdetail (SubTotal)
;

create index orderdetail_UnitPrice_index
	on orderdetail (UnitPrice)
;

create index orderdetail_ibfk_1
	on orderdetail (OrdersID)
;

create index orderdetail_ibfk_2
	on orderdetail (ProductID)
;

create table orders
(
	OrdersID int(10) unsigned auto_increment
		primary key,
	Address varchar(50) null,
	City varchar(50) null,
	Country varchar(50) null,
	FirstName varchar(50) null,
	GST decimal(18,2) not null,
	GrandTotal decimal(18,2) not null,
	LastName varchar(50) null,
	OrderDate date not null,
	Phone varchar(20) null,
	PostalCode varchar(20) null,
	Status varchar(20) null,
	Total decimal(18,2) not null,
	ProductName varchar(100) null,
	UserID int(10) unsigned null
)
;

create index orders_UserID_index
	on orders (UserID)
;

create index orders_ProductName_index
	on orders (ProductName)
;

alter table orderdetail
	add constraint orderdetail_ibfk_1
		foreign key (OrdersID) references orders (OrdersID)
			on update cascade on delete cascade
;

create table products
(
	ProductID int(10) unsigned auto_increment
		primary key,
	CategoryID int(10) unsigned not null,
	Description varchar(500) null,
	ImagePath varchar(1024) null,
	ProductName varchar(100) null,
	SupplierID int(10) unsigned not null,
	UnitPrice decimal(18,2) null,
	constraint products_ibfk_1
		foreign key (CategoryID) references category (CategoryID)
			on update cascade on delete cascade
)
;

create index products_ibfk_1
	on products (CategoryID)
;

create index products_ibfk_2
	on products (SupplierID)
;

create index products_ProductName_index
	on products (ProductName)
;

alter table cartitem
	add constraint cartitem_ibfk_1
		foreign key (ProductID) references products (ProductID)
;

alter table orderdetail
	add constraint orderdetail_ibfk_2
		foreign key (ProductID) references products (ProductID)
			on update cascade on delete cascade
;

create table shoppingcart
(
	ShoppingCartID varchar(450) not null
		primary key
)
;

create table supplier
(
	SupplierID int(10) unsigned auto_increment
		primary key,
	Address varchar(50) not null,
	Email varchar(50) not null,
	MobilePhone varchar(15) null,
	SupplierName varchar(10) not null,
	WorkPhone varchar(10) null
)
;

create index supplier_SupplierName_index
	on supplier (SupplierName)
;

alter table products
	add constraint products_ibfk_2
		foreign key (SupplierID) references supplier (SupplierID)
			on update cascade on delete cascade
;

create table users
(
	UserId int(10) unsigned auto_increment
		primary key,
	Name varchar(50) not null,
	Email varchar(200) not null,
	Password varchar(50) not null,
	Role int(10) unsigned default '0' not null,
	MobileNo varchar(20) null,
	Address varchar(200) null,
	Disabled enum('true', 'false') default 'false' not null,
	EmailConfirmed enum('false', 'true') default 'false' not null
)
;

create index users_Email_index
	on users (Email)
;

alter table orders
	add constraint orders_users_UserId_fk
		foreign key (UserID) references users (UserId)
			on update cascade on delete cascade
;

