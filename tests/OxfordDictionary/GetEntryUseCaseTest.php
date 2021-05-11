<?php

namespace App\Tests\OxfordDictionary;

use App\Service\OxfordDictionary\UseCases\GetEntryUseCase;
use PHPUnit\Framework\TestCase;

class GetEntryUseCaseTest extends TestCase {

    const RESPONSE = <<<'RESPONSE'
[{"word":"book","language":"en-us","lexicalEntries":[{"etymology":"Old English b\u014dc (originally also \u2018a document or charter\u2019), b\u014dcian \u2018to grant by charter\u2019, of Germanic origin; related to Dutch boek and German Buch, and probably to beech (on which runes were carved)","lexicalCategory":"Noun","pronunciations":[{"audioFile":null,"dialects":["American English"],"phoneticNotation":"respell","phoneticSpelling":"bo\u035dok"},{"audioFile":"https:\/\/audio.oxforddictionaries.com\/en\/mp3\/book_us_1.mp3","dialects":["American English"],"phoneticNotation":"IPA","phoneticSpelling":"b\u028ak"}],"senses":[{"definition":"a written or printed work consisting of pages glued or sewn together along one side and bound in covers","domainClass":"Publishing","examples":["a book of selected poems","a book on cats","a book report"]},{"definition":"a bound set of blank sheets for writing or keeping records in","domainClass":null,"examples":["an accounts book"]},{"definition":"a set of tickets, stamps, matches, checks, samples of cloth, etc., bound together","domainClass":null,"examples":["a pattern book","a book of matches"]}],"phrases":["People of the Book","bring someone to book","by the book","close the book on","in my book","in someone's bad books","in someone's good books","make book","on the books","one for the books","suit someone's book","take a page out of someone's book","throw the book at","write the book","you can't judge a book by its cover"]},{"etymology":null,"lexicalCategory":"Verb","pronunciations":[{"audioFile":null,"dialects":["American English"],"phoneticNotation":"respell","phoneticSpelling":"bo\u035dok"},{"audioFile":"https:\/\/audio.oxforddictionaries.com\/en\/mp3\/book_us_1.mp3","dialects":["American English"],"phoneticNotation":"IPA","phoneticSpelling":"b\u028ak"}],"senses":[{"definition":"reserve (accommodations, a place, etc.); buy (a ticket) in advance","domainClass":null,"examples":["I have booked a table at the Swan","book early to avoid disappointment"]},{"definition":"make an official record of the name and other personal details of (a criminal suspect or offender)","domainClass":"Police","examples":["the cop booked me and took me down to the station"]},{"definition":"leave suddenly","domainClass":null,"examples":["they just ate your pizza and drank your soda and booked"]}],"phrases":["People of the Book","bring someone to book","by the book","close the book on","in my book","in someone's bad books","in someone's good books","make book","on the books","one for the books","suit someone's book","take a page out of someone's book","throw the book at","write the book","you can't judge a book by its cover"]}]}]
RESPONSE;

    public function testHandle()
    {
        $entryUseCase = $this->createMock(GetEntryUseCase::class);
        $entryUseCase->expects($this->once())->method('handle')->willReturn(json_decode(self::RESPONSE, true));

        $result = $entryUseCase->handle('book');
        $this->assertIsArray($result);
    }
}
