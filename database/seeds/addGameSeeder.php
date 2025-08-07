<?php

use Illuminate\Database\Seeder;
class addGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $sql="INSERT INTO `add_games` (`id`, `order`, `game_title`, `game_meta`, `game_description`, `base_image`, `game_category`, `game_file`, `json`, `status`, `created_at`, `updated_at`) VALUES
       (2, 16, 'Casino Craps', 'casino, craps, games', 'Casino Craps', '1567519126.15-Casino Craps.jpg', 'Craps', 'casino-craps', 'CrapsWebGL Build', 'on', '2019-09-04 01:58:46', '2019-12-05 19:38:33'),
       (3, 27, 'Roulette', 'Roulette, games', 'Roulette', '1574943334.Thumbnail-15.png', 'Roulette Online', 'roulette', 'Roulette', 'on', '2019-09-04 02:02:30', '2019-12-05 19:38:33'),
       (4, 17, 'Jacks or Better', 'jacks, better, games', 'Jacks or Better', '1567520682.14-JacksOrBetter.jpg', 'Poker Games', 'jacks-or-better', 'Jacks or Better', 'on', '2019-09-04 02:24:42', '2019-12-05 19:38:33'),
       (6, 3, 'Kings Slots', 'king, slot, game', 'Kings Slots', '1574944256.Thumbnail-14.png', 'Classic Slots', 'kings-slots', 'Kings Updated Build', 'on', '2019-09-05 07:45:09', '2019-12-04 19:48:51'),
       (7, 15, 'Sea Hunter Slots', 'Sea, Hunter, games, casino', 'Big  Wins Under the Mighty Sea. Hunt for Free Spins and Bonuses', '1572982382.1572621110.Sea Hunter thumbnail.jpg', 'Classic Slots', 'sea-hunter-slots', 'Sea Hunter', 'on', '2019-09-05 07:52:53', '2019-12-05 19:38:33'),
       (8, 14, 'Pirates Slots', 'pirates, slots, games, casino', 'Pirates Slots', '1574943782.thumbnail-12.png', 'Classic Slots', 'pirates-slots', 'Pirates new slot', 'on', '2019-09-05 07:57:39', '2019-12-05 19:38:33'),
       (9, 8, 'Ocean Slots', 'ocean, slots, games, casino', 'Ocean Slots', '1567627325.8-Ocean Slots.jpg', 'Classic Slots', 'ocean-slots', 'Ocean Slots Rooh', 'on', '2019-09-05 08:02:05', '2019-12-04 19:48:51'),
       (10, 18, 'Era of Egypt', 'egypt, games, slots', 'Era of Egypt', '1574943724.Thumbnail-2.png', 'Classic Slots', 'era-of-egypt', 'Era of Egypt', 'on', '2019-09-05 08:06:38', '2019-12-05 19:38:33'),
       (11, 19, 'Fruits Slots', 'slots, games, casino', 'Fruits Slots', '1567627699.6-Fruit Slots.jpg', 'Classic Slots', 'fruits-slots', 'Fruits Slot', 'on', '2019-09-05 08:08:19', '2019-12-05 19:38:33'),
       (12, 22, 'Vikings Slots', 'vikings, slots, casino, propersix', 'Vikings Slots', '1567627911.5-Vikings Slots.jpg', 'Classic Slots', 'vikings-slots', 'Vikings Slot Final', 'on', '2019-09-05 08:11:51', '2019-12-05 19:38:33'),
       (13, 24, 'Crypto Slots', 'crypto, slots, games, propersix', 'Crypto Slots', '1574943467.Thumbnail-16.png', 'Classic Slots', 'crypto-slots', 'Crypto Slots', 'on', '2019-09-05 08:22:54', '2019-12-05 19:38:33'),
       (14, 23, 'Medieval Slots', 'slots, games, propersix', 'Medieval Slots', '1574943499.Thumbnail-13.png', 'Classic Slots', 'medieval-slots', 'Medival Slots', 'on', '2019-09-05 08:27:41', '2019-12-05 19:38:33'),
       (15, 25, 'Soccer Slots', 'soccer, slots, games, propersix, casino', 'soccer-slots', '1568374495.soccer-slots.jpg', 'Classic Slots', 'soccer-slots', 'Soccer Slots', 'on', '2019-09-13 23:34:55', '2019-12-05 19:38:33'),
       (16, 20, 'Miami Beach Slots', 'miami, beach , slots', 'Enjoy Beach Slots', '1574943676.thumbnail.png', 'Classic Slots', 'miami-beach-slots', 'Beach Slots', 'on', '2019-10-17 22:33:40', '2019-12-05 19:38:33'),
       (17, 26, 'Cave of Wonders', 'enjoy', 'Slots', '1574943443.Thumbnail.jpg', 'Classic Slots', 'cave-of-wonders', 'Aladdin Slots', 'on', '2019-11-01 02:35:00', '2019-12-05 19:38:33'),
       (18, 13, 'Zombie slots', 'casino games', 'enjoy slots', '1574945560.thumbnail zombie with logo.jpg', 'Classic Slots', 'zombie-slots', 'Zombie', 'on', '2019-11-14 22:16:39', '2019-12-05 19:38:33'),
       (20, 12, 'Hunted Slots', 'casino game', 'enjoy', '1574945599.thumbnial with logo.jpg', 'Classic Slots', 'hunted-slots', 'Hunted Slots', 'on', '2019-11-16 00:45:26', '2019-12-05 19:38:33'),
       (21, 21, 'Kungfu Panda', 'casino game', 'enjoy', '1574943621.Thumbnail-4.jpg', 'Classic Slots', 'kungfu-panda', 'kungfupandafinal', 'on', '2019-11-16 20:04:04', '2019-12-05 19:38:33'),
       (22, 1, 'Jungle Book', 'Casino slot', 'enjoy', '1574945653.thumbnail jungle with log.jpg', 'Classic Slots', 'jungle-book', 'Jungle Book', 'on', '2019-11-16 20:28:34', '2019-12-04 19:48:51'),
       (23, 2, 'Bingo', 'Casino bingo', 'enjoy', '1574944273.Thumbnail-7.jpg', 'Bingo', 'bingo', 'ProperGame', 'on', '2019-11-16 20:42:48', '2019-12-04 19:48:51'),
       (24, 4, 'Carribbean\'s Stud Poker', 'casino game', 'enjoy', '1574944007.Thumbnail-10.jpg', 'Poker Games', 'carribbeans-stud-poker', 'ProperGame', 'on', '2019-11-16 20:43:44', '2019-12-04 19:48:51'),
       (25, 5, 'Keno', 'casino game', 'enjoy', '1574943918.Thumbnail-9.jpg', 'Keno', 'keno', 'ProperGame', 'on', '2019-11-16 20:44:24', '2019-12-04 19:48:51'),
       (26, 6, 'Pai Gow Poker', 'casino game', 'enjoy', '1574944230.Pai Gow poker thumbnails.jpg', 'Poker Games', 'pai-gow-poker', 'ProperGame', 'on', '2019-11-16 20:45:00', '2019-12-04 19:48:51'),
       (27, 7, 'Propersix Home Poker', 'casino game', 'enjoy', '1574944205.propersix home  poker.jpg', 'Poker Games', 'propersix-home-poker', 'ProperGame', 'on', '2019-11-16 20:45:54', '2019-12-04 19:48:51'),
       (28, 9, 'Scratch Cards', 'casino game', 'enjoy', '1574944128.Thumbnail-6.jpg', 'Scratch', 'scratch-cards', 'ProperGame', 'on', '2019-11-16 20:47:58', '2019-12-04 19:48:51'),
       (30, 10, 'Texas Hold\'em Bonus Poker', 'casino game', 'enjoy', '1574944167.Texas Hold\'em Bonus Poker thumbnails.jpg', 'Poker Games', 'texas-holdem-bonus-poker', 'ProperGame', 'on', '2019-11-16 20:49:16', '2019-12-05 19:38:33'),
       (31, 11, 'Guardians of Galaxy', 'Casino game', 'enjoy', '1574945619.thunbnail with logo.jpg', 'Classic Slots', 'guardians-of-galaxy', 'Guardians of the Galaxy', 'on', '2019-11-18 22:36:42', '2019-12-05 19:38:33'),
       (36, 28, 'Santa Slots', 'Enjoy Casino Game Santa Slots', 'Christmas is Coming, Welcome to Santa.', '1574864015.thumbnail.jpg', 'Classic Slots', 'santa-slots', 'Santa Slots', 'on', '2019-11-27 19:13:35', '2019-12-18 03:03:01'),
       (37, 29, 'Tens OR Better', 'Casino Game', 'Enjoy Tens Or Better Poker Game', '1574941577.1567622412.16-TensOrBetter.jpg', 'Poker Games', 'tens-or-better', 'TensorBetter', 'on', '2019-11-28 16:46:17', '2019-12-18 03:03:01'),
       (38, 30, 'Proper Keno', 'Casino Game Propersix', 'Enjoy Propersix Keno Game', '1574947967.keno thumbnails.jpg', 'Keno', 'proper-keno', 'Keno', 'on', '2019-11-28 18:32:47', '2019-12-18 03:03:01'),
       (39, 31, 'BlackJack21', 'Casino Game', 'Enjoy BlackJack21', '1574954988.Blackjack thumbnails.jpg', 'Black Jack', 'blackjack21', 'Blackjack21', 'on', '2019-11-28 20:29:48', '2019-12-18 03:03:01'),
       (41, 32, 'Proper BlackJack', 'casino game', 'enjoy', '1575129483.thumbnail.jpeg', 'Black Jack', 'proper-blackjack', 'Proper BlackJack', 'on', '2019-11-30 20:58:03', '2019-12-18 03:03:01'),
       (43, 33, 'Baccarat', 'Casino game', 'Enjoy', '1575471630.Baccarat thumbnail.jpg', 'Baccarat', 'baccarat', 'Baccarat', 'on', '2019-12-04 20:00:30', '2019-12-18 03:03:01'),
       (45, 34, 'Sic Bo', 'Casino Game', 'Enjoy', '1575625844.thumbnail JPG.jpg', 'Sic Bo', 'sic-bo', 'SicBoBuild', 'on', '2019-12-06 14:50:44', '2019-12-18 03:03:01'),
       (46, 35, 'Vegas Billionaire Slots', 'casino game', 'enjoy', '1577101923.Thumbnail.jpg', 'Classic Slots', 'vegas-billionaire-slots', 'Billionaire Slots New', 'on', '2019-12-18 02:50:47', '2019-12-18 03:03:01'),
       (47, 36, 'CashInCars', 'Casino Game', 'Enjoy', '1576941526.Thumbnail.jpg', 'Classic Slots', 'cashincars', 'CashInCars', 'on', '2019-12-21 20:18:46', '2019-12-21 20:18:46')
       ";
         //DB::insert($sql);
    }
}
