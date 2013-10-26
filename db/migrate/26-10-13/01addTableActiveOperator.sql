CREATE TABLE active_operators (
  active INT (2)
  ,user_id INT (30),
  FOREIGN KEY (user_id) REFERENCES users(identification)
)