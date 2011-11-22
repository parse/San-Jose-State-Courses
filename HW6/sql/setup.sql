CREATE SEQUENCE users_id_seq;
CREATE SEQUENCE entries_id_seq;
CREATE SEQUENCE likes_id_seq;

CREATE TABLE profiles (
    ID        int UNIQUE,
    username  varchar(255) NOT NULL,
    password  varchar(255) NOT NULL
);

CREATE TABLE blog (
    ID        int UNIQUE,
    user_id   int,
    title     varchar(255) NOT NULL,
    textentry   text NOT NULL,
    score     int,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE plusones (
    ID        int UNIQUE,
    user_id   int,
    entry_id  int,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now() NOT NULL
);

ALTER TABLE profiles 
  ALTER COLUMN ID 
    SET DEFAULT NEXTVAL('users_id_seq');
        
ALTER TABLE blog 
  ALTER COLUMN ID 
    SET DEFAULT NEXTVAL('entries_id_seq');

ALTER TABLE plusones 
  ALTER COLUMN ID 
    SET DEFAULT NEXTVAL('likes_id_seq');
        
INSERT INTO profiles (username, password) VALUES ('abc', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO profiles (username, password) VALUES ('def', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
INSERT INTO profiles (username, password) VALUES ('ghi', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');
  
INSERT INTO blog (user_id, title, textentry, score) VALUES (1, 'First entry', 'Content goes here', 0);
INSERT INTO blog (user_id, title, textentry, score) VALUES (1, 'Second entry', 'Content goes here', 0);
INSERT INTO blog (user_id, title, textentry, score) VALUES (2, 'Third entry', 'Content goes here', 0);
INSERT INTO blog (user_id, title, textentry, score) VALUES (3, 'Fourth entry', 'Content goes here', 0);
