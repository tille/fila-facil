CREATE TABLE expected_turn (
  module VARCHAR (50)
  ,expected_turn VARCHAR (50)
  ,user_id INT (30),
  FOREIGN KEY (user_id) REFERENCES users(identification)
)