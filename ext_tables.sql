CREATE TABLE sys_file_reference
(
    tx_panopto_player_type  varchar(255) DEFAULT ''  NOT NULL,
    tx_panopto_show_brand   tinyint(4)   DEFAULT '1' NOT NULL,
    tx_panopto_offer_viewer tinyint(4)   DEFAULT '0' NOT NULL,
    tx_panopto_show_title   tinyint(4)   DEFAULT '1' NOT NULL,
    tx_panopto_start_offset int(11)      DEFAULT '0' NOT NULL
);
