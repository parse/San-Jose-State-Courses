
CREATE TABLE users (
    ID        serial CONSTRAINT userkey PRIMARY KEY,
    username  varchar(255) NOT NULL,
    password  varchar(255) NOT NULL
);

INSERT INTO users (ID, username, password) VALUES (1, 'abc', '123');
INSERT INTO users (ID, username, password) VALUES (2, 'def', '123');
INSERT INTO users (ID, username, password) VALUES (3, 'ghi', '123');

CREATE TABLE entries (
    ID        serial CONSTRAINT entrykey PRIMARY KEY,
    user_id   int,
    title     varchar(255) NOT NULL,
    content   text NOT NULL,
    score     int,
    created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now() NOT NULL
);

INSERT INTO entries (ID, user_id, title, content, score) VALUES (1, 1, 'oh hai!', 'content goes here', 0);
INSERT INTO entries (ID, user_id, title, content, score) VALUES (2, 1, 'oh hai2!', 'content goes here', 0);
INSERT INTO entries (ID, user_id, title, content, score) VALUES (3, 2, 'tjo!', 'content goes here', 0);
