/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : elojobx

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 26/06/2021 20:29:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for booster_cupons
-- ----------------------------
DROP TABLE IF EXISTS `booster_cupons`;
CREATE TABLE `booster_cupons`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` decimal(65, 0) NOT NULL DEFAULT 0,
  `discount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime(0) DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booster_cupons
-- ----------------------------
INSERT INTO `booster_cupons` VALUES (1, 'Jobx', 0, '20', '2021-05-19 06:27:28');

-- ----------------------------
-- Table structure for booster_match_records
-- ----------------------------
DROP TABLE IF EXISTS `booster_match_records`;
CREATE TABLE `booster_match_records`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `date` datetime(0) DEFAULT current_timestamp(),
  `match_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booster_match_records
-- ----------------------------
INSERT INTO `booster_match_records` VALUES (47, 88, '[{\"duracao\":\"23:1\",\"criacao\":\"2021-5-21 16:49:40\",\"modo\":\"ARAM\",\"modo2\":450,\"id\":\"BR1_2269509748\",\"result\":{\"assists\":22,\"baronKills\":0,\"bountyLevel\":0,\"champExperience\":23776,\"champLevel\":18,\"championId\":17,\"championName\":\"Teemo\",\"championTransform\":0,\"consumablesPurchased\":0,\"damageDealtToBuildings\":1374,\"damageDealtToObjectives\":1374,\"damageDealtToTurrets\":1374,\"damageSelfMitigated\":13518,\"deaths\":13,\"detectorWardsPlaced\":0,\"doubleKills\":0,\"dragonKills\":0,\"firstBloodAssist\":true,\"firstBloodKill\":false,\"firstTowerAssist\":false,\"firstTowerKill\":false,\"gameEndedInEarlySurrender\":false,\"gameEndedInSurrender\":false,\"goldEarned\":13626,\"goldSpent\":13050,\"individualPosition\":\"Invalid\",\"inhibitorKills\":0,\"inhibitorsLost\":0,\"item0\":6653,\"item1\":4637,\"item2\":3158,\"item3\":3089,\"item4\":1026,\"item5\":4630,\"item6\":2052,\"itemsPurchased\":16,\"killingSprees\":0,\"kills\":3,\"lane\":\"MIDDLE\",\"largestCriticalStrike\":0,\"largestKillingSpree\":0,\"largestMultiKill\":1,\"longestTimeSpentLiving\":145,\"magicDamageDealt\":53452,\"magicDamageDealtToChampions\":22339,\"magicDamageTaken\":18642,\"neutralMinionsKilled\":0,\"nexusKills\":0,\"nexusLost\":0,\"objectivesStolen\":0,\"objectivesStolenAssists\":0,\"participantId\":10,\"pentaKills\":0,\"perks\":{\"statPerks\":{\"defense\":5001,\"flex\":5008,\"offense\":5007},\"styles\":[{\"description\":\"primaryStyle\",\"selections\":[{\"perk\":8128,\"var1\":932,\"var2\":15,\"var3\":0},{\"perk\":8139,\"var1\":1407,\"var2\":0,\"var3\":0},{\"perk\":8138,\"var1\":30,\"var2\":0,\"var3\":0},{\"perk\":8135,\"var1\":2155,\"var2\":5,\"var3\":0}],\"style\":8100},{\"description\":\"subStyle\",\"selections\":[{\"perk\":8009,\"var1\":2842,\"var2\":0,\"var3\":0},{\"perk\":8014,\"var1\":418,\"var2\":0,\"var3\":0}],\"style\":8000}]},\"physicalDamageDealt\":5366,\"physicalDamageDealtToChampions\":824,\"physicalDamageTaken\":9069,\"profileIcon\":4271,\"puuid\":\"untYo1uiHpl_Cc0Am0mEJKZ5wJUj98693S9NpSWRzc5A9-EsTmzpJeEOhKTdaog0WC1WKyaTM-KuZg\",\"quadraKills\":0,\"riotIdName\":\"\",\"riotIdTagline\":\"\",\"role\":\"SUPPORT\",\"sightWardsBoughtInGame\":0,\"spell1Casts\":36,\"spell2Casts\":38,\"spell3Casts\":0,\"spell4Casts\":65,\"summoner1Casts\":5,\"summoner1Id\":21,\"summoner2Casts\":2,\"summoner2Id\":4,\"summonerId\":\"qho64DQphIX1DcYNFwjZI-C-5Fn2F6eOV1k7oT0553-e\",\"summonerLevel\":141,\"summonerName\":\"Castro\",\"teamEarlySurrendered\":false,\"teamId\":200,\"teamPosition\":\"\",\"timeCCingOthers\":37,\"timePlayed\":1401,\"totalDamageDealt\":58819,\"totalDamageDealtToChampions\":23164,\"totalDamageShieldedOnTeammates\":0,\"totalDamageTaken\":27731,\"totalHeal\":4160,\"totalHealsOnTeammates\":0,\"totalMinionsKilled\":35,\"totalTimeCCDealt\":355,\"totalTimeSpentDead\":354,\"totalUnitsHealed\":1,\"tripleKills\":0,\"trueDamageDealt\":0,\"trueDamageDealtToChampions\":0,\"trueDamageTaken\":18,\"turretKills\":1,\"turretsLost\":2,\"unrealKills\":0,\"visionScore\":0,\"visionWardsBoughtInGame\":0,\"wardsKilled\":0,\"wardsPlaced\":0,\"win\":true}},{\"duracao\":\"22:23\",\"criacao\":\"2021-5-20 18:54:46\",\"modo\":\"ARAM\",\"modo2\":450,\"id\":\"BR1_2268917833\",\"result\":{\"assists\":33,\"baronKills\":0,\"bountyLevel\":0,\"champExperience\":24921,\"champLevel\":18,\"championId\":63,\"championName\":\"Brand\",\"championTransform\":0,\"consumablesPurchased\":1,\"damageDealtToBuildings\":1920,\"damageDealtToObjectives\":1920,\"damageDealtToTurrets\":1920,\"damageSelfMitigated\":12266,\"deaths\":12,\"detectorWardsPlaced\":0,\"doubleKills\":2,\"dragonKills\":0,\"firstBloodAssist\":true,\"firstBloodKill\":false,\"firstTowerAssist\":false,\"firstTowerKill\":false,\"gameEndedInEarlySurrender\":false,\"gameEndedInSurrender\":false,\"goldEarned\":16190,\"goldSpent\":14700,\"individualPosition\":\"Invalid\",\"inhibitorKills\":0,\"inhibitorsLost\":1,\"item0\":6653,\"item1\":3135,\"item2\":3157,\"item3\":3089,\"item4\":3020,\"item5\":1058,\"item6\":2052,\"itemsPurchased\":15,\"killingSprees\":4,\"kills\":15,\"lane\":\"MIDDLE\",\"largestCriticalStrike\":0,\"largestKillingSpree\":4,\"largestMultiKill\":2,\"longestTimeSpentLiving\":189,\"magicDamageDealt\":82715,\"magicDamageDealtToChampions\":42106,\"magicDamageTaken\":18505,\"neutralMinionsKilled\":0,\"nexusKills\":0,\"nexusLost\":1,\"objectivesStolen\":0,\"objectivesStolenAssists\":0,\"participantId\":10,\"pentaKills\":0,\"perks\":{\"statPerks\":{\"defense\":5003,\"flex\":5008,\"offense\":5008},\"styles\":[{\"description\":\"primaryStyle\",\"selections\":[{\"perk\":8128,\"var1\":3677,\"var2\":38,\"var3\":0},{\"perk\":8126,\"var1\":956,\"var2\":0,\"var3\":0},{\"perk\":8138,\"var1\":30,\"var2\":0,\"var3\":0},{\"perk\":8135,\"var1\":3182,\"var2\":5,\"var3\":0}],\"style\":8100},{\"description\":\"subStyle\",\"selections\":[{\"perk\":8009,\"var1\":5763,\"var2\":0,\"var3\":0},{\"perk\":8014,\"var1\":1347,\"var2\":0,\"var3\":0}],\"style\":8000}]},\"physicalDamageDealt\":3172,\"physicalDamageDealtToChampions\":579,\"physicalDamageTaken\":5193,\"profileIcon\":4271,\"puuid\":\"untYo1uiHpl_Cc0Am0mEJKZ5wJUj98693S9NpSWRzc5A9-EsTmzpJeEOhKTdaog0WC1WKyaTM-KuZg\",\"quadraKills\":0,\"riotIdName\":\"\",\"riotIdTagline\":\"\",\"role\":\"SUPPORT\",\"sightWardsBoughtInGame\":0,\"spell1Casts\":42,\"spell2Casts\":76,\"spell3Casts\":41,\"spell4Casts\":13,\"summoner1Casts\":6,\"summoner1Id\":21,\"summoner2Casts\":3,\"summoner2Id\":4,\"summonerId\":\"qho64DQphIX1DcYNFwjZI-C-5Fn2F6eOV1k7oT0553-e\",\"summonerLevel\":141,\"summonerName\":\"Castro\",\"teamEarlySurrendered\":false,\"teamId\":200,\"teamPosition\":\"\",\"timeCCingOthers\":20,\"timePlayed\":1356,\"totalDamageDealt\":86768,\"totalDamageDealtToChampions\":43566,\"totalDamageShieldedOnTeammates\":0,\"totalDamageTaken\":24638,\"totalHeal\":3237,\"totalHealsOnTeammates\":0,\"totalMinionsKilled\":43,\"totalTimeCCDealt\":31,\"totalTimeSpentDead\":326,\"totalUnitsHealed\":1,\"tripleKills\":0,\"trueDamageDealt\":880,\"trueDamageDealtToChampions\":880,\"trueDamageTaken\":939,\"turretKills\":1,\"turretsLost\":4,\"unrealKills\":0,\"visionScore\":0,\"visionWardsBoughtInGame\":0,\"wardsKilled\":0,\"wardsPlaced\":0,\"win\":false}},{\"duracao\":\"19:1\",\"criacao\":\"2021-6-4 20:28:56\",\"modo\":\"ARAM\",\"modo2\":450,\"id\":\"BR1_2281381680\",\"result\":{\"assists\":18,\"baronKills\":0,\"bountyLevel\":0,\"champExperience\":15077,\"champLevel\":16,\"championId\":60,\"championName\":\"Elise\",\"championTransform\":0,\"consumablesPurchased\":2,\"damageDealtToBuildings\":633,\"damageDealtToObjectives\":633,\"damageDealtToTurrets\":633,\"damageSelfMitigated\":9458,\"deaths\":9,\"detectorWardsPlaced\":0,\"doubleKills\":2,\"dragonKills\":0,\"firstBloodAssist\":false,\"firstBloodKill\":true,\"firstTowerAssist\":false,\"firstTowerKill\":false,\"gameEndedInEarlySurrender\":false,\"gameEndedInSurrender\":false,\"goldEarned\":12627,\"goldSpent\":10950,\"individualPosition\":\"Invalid\",\"inhibitorKills\":0,\"inhibitorsLost\":0,\"item0\":3020,\"item1\":6655,\"item2\":3157,\"item3\":3165,\"item4\":1058,\"item5\":0,\"item6\":0,\"itemsPurchased\":12,\"killingSprees\":3,\"kills\":10,\"lane\":\"NONE\",\"largestCriticalStrike\":0,\"largestKillingSpree\":3,\"largestMultiKill\":2,\"longestTimeSpentLiving\":243,\"magicDamageDealt\":33599,\"magicDamageDealtToChampions\":16833,\"magicDamageTaken\":6318,\"neutralMinionsKilled\":0,\"nexusKills\":0,\"nexusLost\":0,\"objectivesStolen\":0,\"objectivesStolenAssists\":0,\"participantId\":6,\"pentaKills\":0,\"perks\":{\"statPerks\":{\"defense\":5003,\"flex\":5008,\"offense\":5005},\"styles\":[{\"description\":\"primaryStyle\",\"selections\":[{\"perk\":8112,\"var1\":1114,\"var2\":0,\"var3\":0},{\"perk\":8126,\"var1\":417,\"var2\":0,\"var3\":0},{\"perk\":8138,\"var1\":30,\"var2\":0,\"var3\":0},{\"perk\":8135,\"var1\":1630,\"var2\":5,\"var3\":0}],\"style\":8100},{\"description\":\"subStyle\",\"selections\":[{\"perk\":8210,\"var1\":24,\"var2\":0,\"var3\":0},{\"perk\":8237,\"var1\":578,\"var2\":0,\"var3\":0}],\"style\":8200}]},\"physicalDamageDealt\":3074,\"physicalDamageDealtToChampions\":1320,\"physicalDamageTaken\":10808,\"profileIcon\":4271,\"puuid\":\"untYo1uiHpl_Cc0Am0mEJKZ5wJUj98693S9NpSWRzc5A9-EsTmzpJeEOhKTdaog0WC1WKyaTM-KuZg\",\"quadraKills\":0,\"riotIdName\":\"\",\"riotIdTagline\":\"\",\"role\":\"SUPPORT\",\"sightWardsBoughtInGame\":0,\"spell1Casts\":32,\"spell2Casts\":66,\"spell3Casts\":51,\"spell4Casts\":33,\"summoner1Casts\":7,\"summoner1Id\":32,\"summoner2Casts\":1,\"summoner2Id\":4,\"summonerId\":\"qho64DQphIX1DcYNFwjZI-C-5Fn2F6eOV1k7oT0553-e\",\"summonerLevel\":141,\"summonerName\":\"Castro\",\"teamEarlySurrendered\":false,\"teamId\":200,\"teamPosition\":\"\",\"timeCCingOthers\":16,\"timePlayed\":1164,\"totalDamageDealt\":37362,\"totalDamageDealtToChampions\":18778,\"totalDamageShieldedOnTeammates\":0,\"totalDamageTaken\":19698,\"totalHeal\":3008,\"totalHealsOnTeammates\":0,\"totalMinionsKilled\":22,\"totalTimeCCDealt\":71,\"totalTimeSpentDead\":242,\"totalUnitsHealed\":1,\"tripleKills\":0,\"trueDamageDealt\":689,\"trueDamageDealtToChampions\":624,\"trueDamageTaken\":2571,\"turretKills\":0,\"turretsLost\":0,\"unrealKills\":0,\"visionScore\":0,\"visionWardsBoughtInGame\":0,\"wardsKilled\":0,\"wardsPlaced\":0,\"win\":true}},{\"duracao\":\"16:56\",\"criacao\":\"2021-5-22 17:20:14\",\"modo\":\"ARAM\",\"modo2\":450,\"id\":\"BR1_2270386801\",\"result\":{\"assists\":12,\"baronKills\":0,\"bountyLevel\":1,\"champExperience\":13587,\"champLevel\":15,\"championId\":164,\"championName\":\"Camille\",\"championTransform\":0,\"consumablesPurchased\":0,\"damageDealtToBuildings\":680,\"damageDealtToObjectives\":680,\"damageDealtToTurrets\":680,\"damageSelfMitigated\":18866,\"deaths\":8,\"detectorWardsPlaced\":0,\"doubleKills\":1,\"dragonKills\":0,\"firstBloodAssist\":true,\"firstBloodKill\":false,\"firstTowerAssist\":true,\"firstTowerKill\":false,\"gameEndedInEarlySurrender\":false,\"gameEndedInSurrender\":false,\"goldEarned\":10188,\"goldSpent\":9333,\"individualPosition\":\"Invalid\",\"inhibitorKills\":0,\"inhibitorsLost\":0,\"item0\":3053,\"item1\":3111,\"item2\":3078,\"item3\":1031,\"item4\":1036,\"item5\":1036,\"item6\":2052,\"itemsPurchased\":16,\"killingSprees\":1,\"kills\":7,\"lane\":\"NONE\",\"largestCriticalStrike\":0,\"largestKillingSpree\":3,\"largestMultiKill\":3,\"longestTimeSpentLiving\":142,\"magicDamageDealt\":536,\"magicDamageDealtToChampions\":468,\"magicDamageTaken\":10989,\"neutralMinionsKilled\":0,\"nexusKills\":0,\"nexusLost\":0,\"objectivesStolen\":0,\"objectivesStolenAssists\":0,\"participantId\":10,\"pentaKills\":0,\"perks\":{\"statPerks\":{\"defense\":5001,\"flex\":5002,\"offense\":5008},\"styles\":[{\"description\":\"primaryStyle\",\"selections\":[{\"perk\":8010,\"var1\":243,\"var2\":0,\"var3\":0},{\"perk\":8009,\"var1\":1680,\"var2\":0,\"var3\":0},{\"perk\":9104,\"var1\":9,\"var2\":50,\"var3\":0},{\"perk\":8014,\"var1\":521,\"var2\":0,\"var3\":0}],\"style\":8000},{\"description\":\"subStyle\",\"selections\":[{\"perk\":8143,\"var1\":304,\"var2\":0,\"var3\":0},{\"perk\":8135,\"var1\":666,\"var2\":5,\"var3\":0}],\"style\":8100}]},\"physicalDamageDealt\":16831,\"physicalDamageDealtToChampions\":10558,\"physicalDamageTaken\":8149,\"profileIcon\":4271,\"puuid\":\"untYo1uiHpl_Cc0Am0mEJKZ5wJUj98693S9NpSWRzc5A9-EsTmzpJeEOhKTdaog0WC1WKyaTM-KuZg\",\"quadraKills\":0,\"riotIdName\":\"\",\"riotIdTagline\":\"\",\"role\":\"SUPPORT\",\"sightWardsBoughtInGame\":0,\"spell1Casts\":35,\"spell2Casts\":24,\"spell3Casts\":39,\"spell4Casts\":5,\"summoner1Casts\":15,\"summoner1Id\":32,\"summoner2Casts\":3,\"summoner2Id\":4,\"summonerId\":\"qho64DQphIX1DcYNFwjZI-C-5Fn2F6eOV1k7oT0553-e\",\"summonerLevel\":141,\"summonerName\":\"Castro\",\"teamEarlySurrendered\":false,\"teamId\":200,\"teamPosition\":\"\",\"timeCCingOthers\":16,\"timePlayed\":968,\"totalDamageDealt\":19205,\"totalDamageDealtToChampions\":12734,\"totalDamageShieldedOnTeammates\":0,\"totalDamageTaken\":20416,\"totalHeal\":3434,\"totalHealsOnTeammates\":0,\"totalMinionsKilled\":12,\"totalTimeCCDealt\":71,\"totalTimeSpentDead\":166,\"totalUnitsHealed\":1,\"tripleKills\":1,\"trueDamageDealt\":1837,\"trueDamageDealtToChampions\":1707,\"trueDamageTaken\":1277,\"turretKills\":0,\"turretsLost\":0,\"unrealKills\":0,\"visionScore\":0,\"visionWardsBoughtInGame\":0,\"wardsKilled\":0,\"wardsPlaced\":0,\"win\":true}},{\"duracao\":\"22:23\",\"criacao\":\"2021-5-21 17:16:37\",\"modo\":\"ARAM\",\"modo2\":450,\"id\":\"BR1_2269591754\",\"result\":{\"assists\":38,\"baronKills\":0,\"bountyLevel\":0,\"champExperience\":21902,\"champLevel\":18,\"championId\":143,\"championName\":\"Zyra\",\"championTransform\":0,\"consumablesPurchased\":0,\"damageDealtToBuildings\":446,\"damageDealtToObjectives\":446,\"damageDealtToTurrets\":446,\"damageSelfMitigated\":12844,\"deaths\":15,\"detectorWardsPlaced\":0,\"doubleKills\":1,\"dragonKills\":0,\"firstBloodAssist\":false,\"firstBloodKill\":false,\"firstTowerAssist\":false,\"firstTowerKill\":false,\"gameEndedInEarlySurrender\":false,\"gameEndedInSurrender\":false,\"goldEarned\":14309,\"goldSpent\":13800,\"individualPosition\":\"Invalid\",\"inhibitorKills\":0,\"inhibitorsLost\":1,\"item0\":6653,\"item1\":3158,\"item2\":3165,\"item3\":3135,\"item4\":3116,\"item5\":1058,\"item6\":2052,\"itemsPurchased\":18,\"killingSprees\":2,\"kills\":9,\"lane\":\"TOP\",\"largestCriticalStrike\":0,\"largestKillingSpree\":3,\"largestMultiKill\":3,\"longestTimeSpentLiving\":127,\"magicDamageDealt\":77272,\"magicDamageDealtToChampions\":40387,\"magicDamageTaken\":5785,\"neutralMinionsKilled\":0,\"nexusKills\":0,\"nexusLost\":1,\"objectivesStolen\":0,\"objectivesStolenAssists\":0,\"participantId\":8,\"pentaKills\":0,\"perks\":{\"statPerks\":{\"defense\":5003,\"flex\":5003,\"offense\":5008},\"styles\":[{\"description\":\"primaryStyle\",\"selections\":[{\"perk\":8229,\"var1\":2950,\"var2\":0,\"var3\":0},{\"perk\":8226,\"var1\":250,\"var2\":553,\"var3\":0},{\"perk\":8233,\"var1\":12,\"var2\":10,\"var3\":0},{\"perk\":8236,\"var1\":48,\"var2\":0,\"var3\":0}],\"style\":8200},{\"description\":\"subStyle\",\"selections\":[{\"perk\":8138,\"var1\":30,\"var2\":0,\"var3\":0},{\"perk\":8135,\"var1\":2224,\"var2\":5,\"var3\":0}],\"style\":8100}]},\"physicalDamageDealt\":3563,\"physicalDamageDealtToChampions\":1917,\"physicalDamageTaken\":21379,\"profileIcon\":4271,\"puuid\":\"untYo1uiHpl_Cc0Am0mEJKZ5wJUj98693S9NpSWRzc5A9-EsTmzpJeEOhKTdaog0WC1WKyaTM-KuZg\",\"quadraKills\":0,\"riotIdName\":\"\",\"riotIdTagline\":\"\",\"role\":\"DUO\",\"sightWardsBoughtInGame\":0,\"spell1Casts\":83,\"spell2Casts\":107,\"spell3Casts\":48,\"spell4Casts\":11,\"summoner1Casts\":7,\"summoner1Id\":3,\"summoner2Casts\":2,\"summoner2Id\":4,\"summonerId\":\"qho64DQphIX1DcYNFwjZI-C-5Fn2F6eOV1k7oT0553-e\",\"summonerLevel\":141,\"summonerName\":\"Castro\",\"teamEarlySurrendered\":false,\"teamId\":200,\"teamPosition\":\"\",\"timeCCingOthers\":88,\"timePlayed\":1328,\"totalDamageDealt\":80835,\"totalDamageDealtToChampions\":42305,\"totalDamageShieldedOnTeammates\":0,\"totalDamageTaken\":29166,\"totalHeal\":1890,\"totalHealsOnTeammates\":0,\"totalMinionsKilled\":46,\"totalTimeCCDealt\":265,\"totalTimeSpentDead\":388,\"totalUnitsHealed\":1,\"tripleKills\":1,\"trueDamageDealt\":0,\"trueDamageDealtToChampions\":0,\"trueDamageTaken\":2002,\"turretKills\":0,\"turretsLost\":4,\"unrealKills\":0,\"visionScore\":0,\"visionWardsBoughtInGame\":0,\"wardsKilled\":0,\"wardsPlaced\":0,\"win\":false}}]', '2021-06-25 00:09:05', '[\"BR1_2269509748\",\"BR1_2268917833\",\"BR1_2281381680\",\"BR1_2270386801\",\"BR1_2269591754\"]');

-- ----------------------------
-- Table structure for booster_messages
-- ----------------------------
DROP TABLE IF EXISTS `booster_messages`;
CREATE TABLE `booster_messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `user_send` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` datetime(0) DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 128 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booster_messages
-- ----------------------------
INSERT INTO `booster_messages` VALUES (1, 'asdas', 'amandinha165hz', '66', '2021-05-12 12:00:52');
INSERT INTO `booster_messages` VALUES (2, 'trtr', 'amandinha165hz', '66', '2021-05-12 12:00:52');
INSERT INTO `booster_messages` VALUES (3, 'yy', 'amandinha165hz', '66', '2021-05-12 12:00:52');
INSERT INTO `booster_messages` VALUES (4, 'TESTE', 'castroms', '66', '2021-05-12 12:14:39');
INSERT INTO `booster_messages` VALUES (5, 'Testando enviando mensagem ', 'amandinha165hz', '66', '2021-05-12 17:09:55');
INSERT INTO `booster_messages` VALUES (6, 'Scrol?', 'amandinha165hz', '66', '2021-05-12 17:09:58');
INSERT INTO `booster_messages` VALUES (7, 'Sim, o scrol esta ok,mas esse chat é muito estranho', 'castroms', '66', '2021-05-12 17:10:45');
INSERT INTO `booster_messages` VALUES (8, 'ASD', 'amandinha165hz', '70', '2021-05-13 01:28:09');
INSERT INTO `booster_messages` VALUES (9, 'Ola', 'amandinha165hz', '77', '2021-05-13 23:43:15');
INSERT INTO `booster_messages` VALUES (29, 'teste', 'castroms', '80', '2021-05-28 12:49:33');
INSERT INTO `booster_messages` VALUES (74, 'Teste no client', 'amandinha165hz', '80', '2021-05-28 20:07:43');
INSERT INTO `booster_messages` VALUES (75, 'x', 'castroms', '80', '2021-05-28 20:08:11');
INSERT INTO `booster_messages` VALUES (76, 'asd', 'castroms', '80', '2021-05-28 20:08:14');
INSERT INTO `booster_messages` VALUES (77, '2312312', 'castroms', '80', '2021-05-28 20:08:16');
INSERT INTO `booster_messages` VALUES (78, '\' OR 1 =1', 'castroms', '80', '2021-05-29 12:10:12');
INSERT INTO `booster_messages` VALUES (79, '\" OR 1 =1', 'castroms', '80', '2021-05-29 12:10:18');
INSERT INTO `booster_messages` VALUES (80, 'typeof var x = 1 * 2', 'castroms', '80', '2021-05-29 12:10:31');
INSERT INTO `booster_messages` VALUES (81, 'asd', 'amandinha165hz', '88', '2021-06-12 02:45:51');
INSERT INTO `booster_messages` VALUES (82, 'e faz essa porra ligero que to com pressa', 'amandinha165hz', '76', '2021-06-12 02:48:33');
INSERT INTO `booster_messages` VALUES (83, 'nessa porra mermao', 'amandinha165hz', '76', '2021-06-12 02:48:38');
INSERT INTO `booster_messages` VALUES (84, 'asd', 'castroms', '76', '2021-06-12 11:32:52');
INSERT INTO `booster_messages` VALUES (85, 'teste', 'amandinha165hz', '76', '2021-06-12 12:00:08');
INSERT INTO `booster_messages` VALUES (86, 'XX', 'amandinha165hz', '76', '2021-06-12 12:02:35');
INSERT INTO `booster_messages` VALUES (87, 'tssa', 'amandinha165hz', '76', '2021-06-12 12:06:23');
INSERT INTO `booster_messages` VALUES (88, 'fga', 'amandinha165hz', '76', '2021-06-12 12:07:45');
INSERT INTO `booster_messages` VALUES (89, 'zxcf', 'amandinha165hz', '76', '2021-06-12 12:10:24');
INSERT INTO `booster_messages` VALUES (90, 'zxc12', 'amandinha165hz', '76', '2021-06-12 12:18:33');
INSERT INTO `booster_messages` VALUES (91, 'XXXXXXXXX', 'amandinha165hz', '76', '2021-06-12 12:21:00');
INSERT INTO `booster_messages` VALUES (92, 'Ouue', 'castroms', '76', '2021-06-12 12:22:38');
INSERT INTO `booster_messages` VALUES (93, 'Ouue2', 'castroms', '76', '2021-06-12 12:28:34');
INSERT INTO `booster_messages` VALUES (94, 'x', 'castroms', '76', '2021-06-12 12:28:58');
INSERT INTO `booster_messages` VALUES (95, 'XA', 'castroms', '76', '2021-06-12 12:29:33');
INSERT INTO `booster_messages` VALUES (96, 'testea', 'amandinha165hz', '76', '2021-06-12 12:29:39');
INSERT INTO `booster_messages` VALUES (97, 'Ola', 'eduhcastro19', '88', '2021-06-23 20:44:31');
INSERT INTO `booster_messages` VALUES (122, 'asd', 'eduhcastro19', '88', '2021-06-24 12:39:42');
INSERT INTO `booster_messages` VALUES (123, 'asd', 'eduhcastro19', '88', '2021-06-24 12:39:58');
INSERT INTO `booster_messages` VALUES (124, 'd', 'eduhcastro19', '88', '2021-06-24 12:41:54');
INSERT INTO `booster_messages` VALUES (125, 'teste', 'eduhcastro19', '88', '2021-06-24 18:52:20');
INSERT INTO `booster_messages` VALUES (126, 'XXX', 'amandinha165hz', '88', '2021-06-25 11:49:27');
INSERT INTO `booster_messages` VALUES (127, 'asd', 'amandinha165hz', '88', '2021-06-25 11:50:04');

-- ----------------------------
-- Table structure for booster_more
-- ----------------------------
DROP TABLE IF EXISTS `booster_more`;
CREATE TABLE `booster_more`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 92 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booster_more
-- ----------------------------
INSERT INTO `booster_more` VALUES (2, 3, '');
INSERT INTO `booster_more` VALUES (3, 4, '');
INSERT INTO `booster_more` VALUES (4, 5, '');
INSERT INTO `booster_more` VALUES (5, 6, '');
INSERT INTO `booster_more` VALUES (6, 7, '');
INSERT INTO `booster_more` VALUES (7, 8, '');
INSERT INTO `booster_more` VALUES (8, 9, '');
INSERT INTO `booster_more` VALUES (9, 10, '');
INSERT INTO `booster_more` VALUES (10, 11, '');
INSERT INTO `booster_more` VALUES (11, 12, '');
INSERT INTO `booster_more` VALUES (12, 13, '');
INSERT INTO `booster_more` VALUES (13, 14, '');
INSERT INTO `booster_more` VALUES (14, 15, '');
INSERT INTO `booster_more` VALUES (15, 16, '');
INSERT INTO `booster_more` VALUES (16, 17, '');
INSERT INTO `booster_more` VALUES (17, 18, '');
INSERT INTO `booster_more` VALUES (18, 19, '');
INSERT INTO `booster_more` VALUES (19, 20, '');
INSERT INTO `booster_more` VALUES (20, 21, '');
INSERT INTO `booster_more` VALUES (21, 22, '');
INSERT INTO `booster_more` VALUES (22, 23, '');
INSERT INTO `booster_more` VALUES (23, 24, '');
INSERT INTO `booster_more` VALUES (24, 25, '');
INSERT INTO `booster_more` VALUES (25, 26, '');
INSERT INTO `booster_more` VALUES (26, 27, '');
INSERT INTO `booster_more` VALUES (27, 28, '');
INSERT INTO `booster_more` VALUES (28, 29, '');
INSERT INTO `booster_more` VALUES (29, 30, '');
INSERT INTO `booster_more` VALUES (30, 31, '');
INSERT INTO `booster_more` VALUES (31, 32, '');
INSERT INTO `booster_more` VALUES (32, 33, '');
INSERT INTO `booster_more` VALUES (33, 34, '');
INSERT INTO `booster_more` VALUES (34, 35, '');
INSERT INTO `booster_more` VALUES (35, 36, '');
INSERT INTO `booster_more` VALUES (36, 37, '');
INSERT INTO `booster_more` VALUES (37, 38, '');
INSERT INTO `booster_more` VALUES (38, 39, '');
INSERT INTO `booster_more` VALUES (39, 40, '');
INSERT INTO `booster_more` VALUES (40, 41, '');
INSERT INTO `booster_more` VALUES (41, 42, '');
INSERT INTO `booster_more` VALUES (42, 43, '');
INSERT INTO `booster_more` VALUES (43, 44, '');
INSERT INTO `booster_more` VALUES (44, 45, '');
INSERT INTO `booster_more` VALUES (45, 46, '');
INSERT INTO `booster_more` VALUES (46, 47, '');
INSERT INTO `booster_more` VALUES (47, 48, '');
INSERT INTO `booster_more` VALUES (48, 49, '');
INSERT INTO `booster_more` VALUES (49, 50, '');
INSERT INTO `booster_more` VALUES (50, 51, '');
INSERT INTO `booster_more` VALUES (51, 52, '');
INSERT INTO `booster_more` VALUES (52, 53, '');
INSERT INTO `booster_more` VALUES (53, 54, '');
INSERT INTO `booster_more` VALUES (54, 55, '');
INSERT INTO `booster_more` VALUES (55, 56, '');
INSERT INTO `booster_more` VALUES (56, 57, '');
INSERT INTO `booster_more` VALUES (57, 58, '');
INSERT INTO `booster_more` VALUES (58, 59, '');
INSERT INTO `booster_more` VALUES (59, 60, '');
INSERT INTO `booster_more` VALUES (60, 61, '');
INSERT INTO `booster_more` VALUES (61, 62, '');
INSERT INTO `booster_more` VALUES (62, 63, '');
INSERT INTO `booster_more` VALUES (63, 64, '');
INSERT INTO `booster_more` VALUES (64, 65, '');
INSERT INTO `booster_more` VALUES (65, 66, '');
INSERT INTO `booster_more` VALUES (66, 67, '');
INSERT INTO `booster_more` VALUES (67, 68, '');
INSERT INTO `booster_more` VALUES (68, 69, '');
INSERT INTO `booster_more` VALUES (69, 70, '');
INSERT INTO `booster_more` VALUES (70, 71, '');
INSERT INTO `booster_more` VALUES (71, 72, '');
INSERT INTO `booster_more` VALUES (72, 73, '');
INSERT INTO `booster_more` VALUES (73, 74, '');
INSERT INTO `booster_more` VALUES (74, 75, '');
INSERT INTO `booster_more` VALUES (75, 76, '');
INSERT INTO `booster_more` VALUES (76, 77, '');
INSERT INTO `booster_more` VALUES (77, 78, '');
INSERT INTO `booster_more` VALUES (78, 79, '');
INSERT INTO `booster_more` VALUES (79, 80, '');
INSERT INTO `booster_more` VALUES (80, 81, '');
INSERT INTO `booster_more` VALUES (81, 82, '');
INSERT INTO `booster_more` VALUES (82, 83, '');
INSERT INTO `booster_more` VALUES (83, 84, '');
INSERT INTO `booster_more` VALUES (84, 85, '');
INSERT INTO `booster_more` VALUES (85, 86, '');
INSERT INTO `booster_more` VALUES (86, 87, '');
INSERT INTO `booster_more` VALUES (87, 88, '');
INSERT INTO `booster_more` VALUES (88, 89, '');
INSERT INTO `booster_more` VALUES (89, 90, '');
INSERT INTO `booster_more` VALUES (90, 91, '');
INSERT INTO `booster_more` VALUES (91, 92, '');

-- ----------------------------
-- Table structure for elo_users
-- ----------------------------
DROP TABLE IF EXISTS `elo_users`;
CREATE TABLE `elo_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `celular` decimal(65, 0) DEFAULT NULL,
  `level` int(65) DEFAULT 0,
  `deslike` int(65) DEFAULT 0,
  `likes` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `created` datetime(0) DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of elo_users
-- ----------------------------
INSERT INTO `elo_users` VALUES (10, 'castroms', '$2y$10$6ZMupdQ/xSo1MagP3aap0OswNn/J1Q6EmF1NLTra6Ih1WdlPN4gYy', 'Castro Silva', 'projecflexxx@gmail.com', NULL, 3, 0, '1', '2021-06-13 18:13:00');
INSERT INTO `elo_users` VALUES (12, 'amandinha165hz', '$2b$10$cXP26aopd3OJvWkSxpPWQ.3D25hLFac4g6JAPrgWm5.IdXGLLwQy6', 'Amandinha', 'projecflex@gmail.com', NULL, 0, 0, '0', '2021-06-13 18:13:00');
INSERT INTO `elo_users` VALUES (20, 'Eduardo2', '$2b$10$S7ME.72e5p1Ko6hTmz1xXeb4YQ1dtLWa5wOMpMQb03Bt5b8/L4l6u', 'Eduardo Castro', 'adasd@asdas.com', 749848484, 2, 0, '0', '2021-06-13 18:13:00');
INSERT INTO `elo_users` VALUES (21, 'eduhcastro19', '$2b$10$7O.fusHi.ZBcscljaeiake.rXP.5D/gVcqhzF5/thHrIEgDRZzNra', 'Eduardo Castro', 'eduh.castro19@gmail.com', 74988459697, 2, 0, '0', '2021-06-14 18:13:00');

-- ----------------------------
-- Table structure for elo_users_accounts
-- ----------------------------
DROP TABLE IF EXISTS `elo_users_accounts`;
CREATE TABLE `elo_users_accounts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `conta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `invocador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `working` decimal(65, 0) DEFAULT 0,
  `playing` decimal(65, 0) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of elo_users_accounts
-- ----------------------------
INSERT INTO `elo_users_accounts` VALUES (56, 'amandinha165hz', 'amandinha165hz', 'zxcdewq', 'Homem Deita2', 1, 0);
INSERT INTO `elo_users_accounts` VALUES (57, 'amandinha165hz', 'zxca22', 'xcsd', 'Nerd', 1, 0);
INSERT INTO `elo_users_accounts` VALUES (58, 'amandinha165hz', 'teste123xxxc', 'tesw', 'CocaCu', 1, 0);
INSERT INTO `elo_users_accounts` VALUES (59, 'amandinha165hz', 'asd213', 'zxcasd', 'Edo Sophy', 1, 0);
INSERT INTO `elo_users_accounts` VALUES (60, 'amandinha165hz', 'exbom123', 'zxcdewq', 'Homem Deita', 1, 0);
INSERT INTO `elo_users_accounts` VALUES (70, 'Eduardo2', NULL, NULL, NULL, 0, 0);
INSERT INTO `elo_users_accounts` VALUES (71, 'amandinha165hz', 'Castroms', '123', 'Castro', 1, 2);
INSERT INTO `elo_users_accounts` VALUES (82, 'amandinha165hz', 'Eduardo', '123', 'Pump', 1, 0);

-- ----------------------------
-- Table structure for elo_users_comments
-- ----------------------------
DROP TABLE IF EXISTS `elo_users_comments`;
CREATE TABLE `elo_users_comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classificacao` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of elo_users_comments
-- ----------------------------
INSERT INTO `elo_users_comments` VALUES (14, '10', '[{\"usuario\":\"amandinha165hz\",\"order\":\"76\",\"mensagem\":\"Otimo trabalho o cuzao\",\"avaliacao\":\"0\",\"date\":\"26\\/06\\/2021 12:02\"}]');

-- ----------------------------
-- Table structure for elo_users_invoices
-- ----------------------------
DROP TABLE IF EXISTS `elo_users_invoices`;
CREATE TABLE `elo_users_invoices`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `payment` decimal(1, 0) NOT NULL DEFAULT 1,
  `date` datetime(0) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `valor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_aproved` datetime(0) DEFAULT NULL,
  `booster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `finish_date` datetime(0) DEFAULT NULL,
  `assessment` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of elo_users_invoices
-- ----------------------------
INSERT INTO `elo_users_invoices` VALUES (76, 'amandinha165hz', '{\"Curso\":\"intermediario\",\"Aulas\":\"6\",\"Detalhes\":{\"invocador\":\"Katapimbas\",\"rota\":\"mid\",\"dias\":[\"segunda-feira\",\"terca-feira\",\"quarta-feira\"],\"horarios\":\"Lixa\",\"boosterfavorito_booster\":\"\",\"cupom\":\"Jobx\",\"submit\":\"1\"}}', 3, '2021-05-13 22:56:18', '0', 'R$ 1,00', '2021-06-12 02:15:01', '10', '15320179199', '2021-06-12 13:06:06', 0);
INSERT INTO `elo_users_invoices` VALUES (88, 'amandinha165hz', '{\"Submit\":\"1\",\"AccountMethod\":\"adicionarconta\",\"Login\":\"Castroms\",\"Summoner\":\"Castro\",\"Password\":\"123\",\"RPassword\":\"123\",\"Chat\":\"1\",\"RateMMR\":\"1\",\"PrioritySER\":\"1\",\"ExtraWin\":\"1\",\"StreamON\":\"1\",\"KDAReduce\":\"1\",\"SpellsPosi\":\"1\",\"FlashPosi\":\"F\",\"SpecificRO\":\"1\",\"RoutePrimary\":\"jng\",\"RouteSecondary\":\"sup\",\"BoosterFavority\":\"1\",\"BoosterFavorityB\":\"20\",\"SpecificCHAMPs\":\"1\",\"Champions\":[\"4\",\"62\",\"71\",\"76\",\"79\",\"85\",\"162\",\"100\",\"106\",\"109\"],\"Mastery\":\"1\",\"MasteryHero\":[\"71\\/m4\",\"109\\/m6\"],\"SchedulesREST\":\"1\",\"Schedules\":\"Jogo todo dia,nao entrem na minha conta\",\"EloSelecionado\":\"prata\",\"EloDesejado\":\"mestre\",\"DivisaoSelecionada\":\"IV\",\"DivisaoDesejada\":\"III\",\"Fila\":\"solo/duo\",\"Servico\":\"eloboost\",\"Prazo\":23}', 2, '2021-06-12 02:39:07', '0', 'R$ 1.633,65', '2021-06-23 18:22:53', '21', NULL, NULL, NULL);
INSERT INTO `elo_users_invoices` VALUES (92, 'amandinha165hz', '{\"Submit\":\"1\",\"AccountMethod\":\"adicionarconta\",\"Login\":\"Eduardo\",\"Summoner\":\"Pump\",\"Password\":\"123\",\"RPassword\":\"123\",\"Chat\":\"1\",\"SpellsPosi\":\"1\",\"FlashPosi\":\"F\",\"RoutePrimary\":\"mid\",\"RouteSecondary\":\"top\",\"EloSelecionado\":\"prata\",\"EloDesejado\":\"diamante\",\"DivisaoSelecionada\":\"IV\",\"DivisaoDesejada\":\"III\",\"Fila\":\"flex\",\"Servico\":\"eloboost\",\"Prazo\":15}', 1, '2021-06-25 12:35:02', '0', 'R$ 287,00', NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for elo_users_lostpassword
-- ----------------------------
DROP TABLE IF EXISTS `elo_users_lostpassword`;
CREATE TABLE `elo_users_lostpassword`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` datetime(0) NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for elo_users_personalization
-- ----------------------------
DROP TABLE IF EXISTS `elo_users_personalization`;
CREATE TABLE `elo_users_personalization`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '1',
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '1',
  `thema` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'fancy',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of elo_users_personalization
-- ----------------------------
INSERT INTO `elo_users_personalization` VALUES (4, 'castroms', '7', '1', 'night');
INSERT INTO `elo_users_personalization` VALUES (6, 'amandinha165hz', '3', '2', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (14, 'Eduardo2', '5', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (15, 'eduhcastro19', '9', '3', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (16, 'castroms2', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (17, 'castroms3', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (18, 'castroms3', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (19, 'castroms4', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (20, 'aaaaaa', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (21, 'ZXC', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (22, 'ASDASD', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (23, 'cxcxz', '1', '1', 'fancy');
INSERT INTO `elo_users_personalization` VALUES (24, 'CZXASDQ12', '1', '1', 'fancy');

-- ----------------------------
-- Table structure for elo_users_tickets
-- ----------------------------
DROP TABLE IF EXISTS `elo_users_tickets`;
CREATE TABLE `elo_users_tickets`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `setor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prioridade` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` decimal(65, 0) DEFAULT NULL,
  `identificador` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vbooster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `assunto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mensagem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for orders_tokens
-- ----------------------------
DROP TABLE IF EXISTS `orders_tokens`;
CREATE TABLE `orders_tokens`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` datetime(0) DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 65 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders_tokens
-- ----------------------------
INSERT INTO `orders_tokens` VALUES (63, '6gnfZHbIrEzfPegeFNkxyM90Loq92FMm5JCApa4tBoEyJlnDRv', '76', '2021-06-12 02:21:37');
INSERT INTO `orders_tokens` VALUES (64, '802n7rFSZJUSREBu1fK8uc7xB5NNqo7TW4AjuU3BIQIBgkry8T', '92', '2021-06-25 12:35:04');

-- ----------------------------
-- Table structure for personalization_avatar
-- ----------------------------
DROP TABLE IF EXISTS `personalization_avatar`;
CREATE TABLE `personalization_avatar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personalization_avatar
-- ----------------------------
INSERT INTO `personalization_avatar` VALUES (1, 'Yasuo DarkBlue', '1.png');
INSERT INTO `personalization_avatar` VALUES (3, 'One', '1-new.jpg');
INSERT INTO `personalization_avatar` VALUES (5, 'Two', '2-new.png');
INSERT INTO `personalization_avatar` VALUES (7, 'Three', '3-new.png');
INSERT INTO `personalization_avatar` VALUES (8, 'Mystic', '0.png');
INSERT INTO `personalization_avatar` VALUES (9, 'Boladao Asd', '6-new.png');

-- ----------------------------
-- Table structure for personalization_banner
-- ----------------------------
DROP TABLE IF EXISTS `personalization_banner`;
CREATE TABLE `personalization_banner`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personalization_banner
-- ----------------------------
INSERT INTO `personalization_banner` VALUES (1, 'Unknown', '0.jpg');
INSERT INTO `personalization_banner` VALUES (2, 'Unknown2', '1.png');
INSERT INTO `personalization_banner` VALUES (3, 'Unknown3', '2.jpg');
INSERT INTO `personalization_banner` VALUES (6, 'Na Praia', 'Banner-praia.png');

-- ----------------------------
-- Table structure for personalization_themes
-- ----------------------------
DROP TABLE IF EXISTS `personalization_themes`;
CREATE TABLE `personalization_themes`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ref_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personalization_themes
-- ----------------------------
INSERT INTO `personalization_themes` VALUES (1, 'Elo1', 'fancy', '#8333FF');
INSERT INTO `personalization_themes` VALUES (2, 'Elo2', 'night', '#272727');
INSERT INTO `personalization_themes` VALUES (4, 'ROXO AQUI OK', 'themecolorroxo.css', '#4600FF');

-- ----------------------------
-- Table structure for updates_published
-- ----------------------------
DROP TABLE IF EXISTS `updates_published`;
CREATE TABLE `updates_published`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` datetime(0) DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of updates_published
-- ----------------------------
INSERT INTO `updates_published` VALUES (1, 'Discord', '   <h3>Discord OFICIAL - ELOJOBHIGH</h3>\n                           <p><a href=\"https://elojobhigh.com.br/app/perfil/Alan\" title=\"Lanzin\"><img src=\"https://elojobhigh.com.br/app/assets/imagens/avatares/e12e001a130b4df0eea2df5a5772a456.png\" alt=\"Lanzin\" class=\"img-circle\" style=\"max-height: 50px;\"><br><small>Lanzin</small></a></p>\n                           <p>12/01/2021 19:52:00</p>\n                           <p><a href=\"https://discord.gg/GZBWx9SN57\"><img alt=\"\" src=\"https://i.imgur.com/H7j2C5v.png\" /></a></p>\n                           <p><em><strong>CLIQUE NO ICONE DO DISCORD</strong></em></p>\n                           <p>&nbsp;</p>\n                           <p><strong>Tutorial de Acesso e Download:</strong></p>\n                           <p>&nbsp;</p>\n                           <p>&nbsp;</p>\n                           <p><strong>Passo 1:</strong> Baixar o Discord (ele pode ser usado em mobile, desktop, web - recomendamos a desktop).<br />\n                              <br />\n                              <strong>Passo 2:</strong> Adicionar um servidor na barra esquerda do aplicativo.<br />\n                              <br />\n                              <strong>Passo 3:</strong> Colar o seguinte discord.gg/GZBWx9SN57\n                           </p>\n                           <p>&nbsp;</p>\n                           <p>&nbsp;</p>\n                           <p>Para acessar novamente o servidor, basta clicar no &iacute;cone do <strong>servidor</strong>.</p>\n                           <p>&nbsp;</p>\n                           <p>&nbsp;</p>\n                           <p>&nbsp;</p>\n                           <p><br />\n                              &nbsp;\n                           </p>', 'castroms', '2021-04-27 18:50:19');
INSERT INTO `updates_published` VALUES (2, 'X', 'X', 'castroms', '2021-04-30 21:26:47');
INSERT INTO `updates_published` VALUES (4, 'Z', 'Z', 'castroms', '2021-04-30 21:26:49');
INSERT INTO `updates_published` VALUES (5, 'Ola, este é meu painel!', 'T', 'castroms', '2021-04-30 21:26:57');
INSERT INTO `updates_published` VALUES (6, 'C', 'C', 'castroms', '2021-04-30 21:26:54');

-- ----------------------------
-- Triggers structure for table elo_users
-- ----------------------------
DROP TRIGGER IF EXISTS `personalizacao`;
delimiter ;;
CREATE DEFINER = `root`@`localhost` TRIGGER `personalizacao` AFTER INSERT ON `elo_users` FOR EACH ROW BEGIN
INSERT INTO elo_users_personalization (usuario) VALUES (NEW.user);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table elo_users
-- ----------------------------
DROP TRIGGER IF EXISTS `accounts`;
delimiter ;;
CREATE DEFINER = `root`@`localhost` TRIGGER `accounts` AFTER INSERT ON `elo_users` FOR EACH ROW BEGIN
INSERT INTO elo_users_accounts (usuario) VALUES (NEW.user);
END
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table elo_users_invoices
-- ----------------------------
DROP TRIGGER IF EXISTS `INSERT MORE`;
delimiter ;;
CREATE DEFINER = `root`@`localhost` TRIGGER `INSERT MORE` AFTER INSERT ON `elo_users_invoices` FOR EACH ROW BEGIN
INSERT INTO booster_more (invoice_id) VALUES (NEW.id);
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
