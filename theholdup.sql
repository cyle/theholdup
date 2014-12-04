CREATE DATABASE IF NOT EXISTS `theholdup` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `theholdup`;

CREATE TABLE `projects` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`uid` int(11) NOT NULL,
	`name` text NOT NULL,
	`status` text NOT NULL,
	`done` tinyint(1) NOT NULL,
	`displayorder` int(11) NOT NULL,
	`tsc` int(11) NOT NULL,
	`tsu` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(50) NOT NULL,
	`userlevel` tinyint(4) NOT NULL,
	`public` tinyint(4) NOT NULL DEFAULT '0',
	`tsc` int(11) NOT NULL,
	`tsu` int(11) NOT NULL,
	`lastactivity` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE `projects`
ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
ADD PRIMARY KEY (`id`);