--
-- Creating a User table.
--

--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT UNIQUE NOT NULL,
    "password" TEXT,
    "info" TEXT
);

--
-- Table Post
--
DROP TABLE IF EXISTS Post;
CREATE TABLE Post (
    "postId" INTEGER PRIMARY KEY NOT NULL,
    "acronym" TEXT NOT NULL,
    "title" TEXT,
    "text" TEXT
);

--
-- Table Comment
--
DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    "commentId" INTEGER PRIMARY KEY NOT NULL,
    "postId" TEXT NOT NULL,
    "replyId" INTEGER,
    "id" INTEGER,
    "text" TEXT
);

--
-- Table Tag
--
DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag (
    "tagId" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT NOT NULL,
    "postId" TEXT NOT NULL
);
