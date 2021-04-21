-- TODO for Billy (Task 2): Fix attribute definition.
--  For some reason we can't save long attribute values. Tested with short value (43 characters) and it worked,
--  but tried long value (323 characters) and I got error:
--  "[22001][1406] Data truncation: Data too long for column 'attributes' at row 1"
--  Please fix :(

CREATE SCHEMA great_database;

CREATE TABLE great_database.products
(
    id int auto_increment
        primary key,
    sku varchar(255) not null,
    product_name varchar(255) not null,
    price double not null,
    attributes varchar(255) null,
    constraint products_sku_uindex
        unique (sku)
);

