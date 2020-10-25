#
# Table structure for table 'myMedia'
#

CREATE TABLE myMedia (
    id           INT(11)          NOT NULL AUTO_INCREMENT,
    pid          INT(6) UNSIGNED           DEFAULT '0',
    uid          INT(6) UNSIGNED           DEFAULT '1',
    datesub      INT(11) UNSIGNED NOT NULL DEFAULT '1033141070',
    subject      VARCHAR(255)              DEFAULT NULL,
    informations TEXT,
    nohtml       TINYINT(1) UNSIGNED       DEFAULT '0',
    nosmiley     TINYINT(1) UNSIGNED       DEFAULT '0',
    noxcode      TINYINT(1) UNSIGNED       DEFAULT '0',
    notitle      TINYINT(1) UNSIGNED       DEFAULT '0',
    nologo       TINYINT(1) UNSIGNED       DEFAULT '0',
    nomain       TINYINT(1) UNSIGNED       DEFAULT '0',
    noblock      TINYINT(1) UNSIGNED       DEFAULT '0',
    counter      INT(8) UNSIGNED           DEFAULT '0',
    offline      TINYINT(1) UNSIGNED       DEFAULT '1',
    media        VARCHAR(255)     NOT NULL DEFAULT '',
    media_url    VARCHAR(255)     NOT NULL DEFAULT '',
    media_size   VARCHAR(10)      NOT NULL DEFAULT '',
    cancomment   TINYINT(1) UNSIGNED       DEFAULT '1',
    artimage     VARCHAR(255)     NOT NULL DEFAULT 'blank.gif',
    groups       VARCHAR(255)     NOT NULL DEFAULT '',
    hidden       TINYINT(1) UNSIGNED       DEFAULT '0',
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

