-- TODO for Johnny (Task 2.3): Add attribute table
--  We need to move attributes to a separate table. Why?
--  1. We need to be able to sort and filter products by attributes. Not doable if they are serialized.
--  2. Client hinted that they might create a product type with 200 attributes in the future. That means that
--    just adding column for each attribute in the product table is out of the question.



