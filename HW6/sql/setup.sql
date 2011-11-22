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
