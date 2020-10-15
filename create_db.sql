CREATE TABLE `subscribers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(255) NOT NULL, -- According to RFC 5321, forward and reverse path can be up to 256 chars long, so the email address can be up to 254 characters long. We are safe with using 255 chars. https://stackoverflow.com/a/8242609
  `name` char(225) NOT NULL,
  `state` enum('active','unsubscribed','junk','bounced','unconfirmed') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
