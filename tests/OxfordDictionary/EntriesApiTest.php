<?php

namespace tests\OxfordDictionary;

use App\Service\OxfordDictionary\Clients\HttpClientInterface;
use App\Service\OxfordDictionary\Exceptions\ApiException;
use App\Service\OxfordDictionary\Models\Entries\Entry;
use App\Service\OxfordDictionary\Models\Entries\LexicalEntry;
use App\Service\OxfordDictionary\Models\Entries\Pronunciation;
use App\Service\OxfordDictionary\Models\Entries\Sense;
use App\Service\OxfordDictionary\Apis\EntriesApi;
use PHPUnit\Framework\TestCase;

class EntriesApiTest extends TestCase
{
    const RESPONSE = <<<'RESPONSE'
    {
        "id": "ace",
        "metadata": {
            "operation": "retrieve",
            "provider": "Oxford University Press",
            "schema": "RetrieveEntry"
        },
        "results": [
            {
                "id": "ace",
                "language": "en-gb",
                "lexicalEntries": [
                    {
                        "entries": [
                            {
                                "etymologies": [
                                    "Middle English (denoting the ‘one’ on dice): via Old French from Latin as ‘unity, a unit’"
                                ],
                                "homographNumber": "100",
                                "pronunciations": [
                                    {
                                        "audioFile": "https://audio.oxforddictionaries.com/en/mp3/ace_1_gb_1_abbr.mp3",
                                        "dialects": [
                                            "British English"
                                        ],
                                        "phoneticNotation": "IPA",
                                        "phoneticSpelling": "eɪs"
                                    }
                                ],
                                "senses": [
                                    {
                                        "definitions": [
                                            "a playing card with a single spot on it, ranked as the highest card in its suit in most card games"
                                        ],
                                        "domainClasses": [
                                            {
                                                "id": "cards",
                                                "text": "Cards"
                                            }
                                        ],
                                        "examples": [
                                            {
                                                "text": "the ace of diamonds"
                                            },
                                            {
                                                "registers": [
                                                    {
                                                        "id": "figurative",
                                                        "text": "Figurative"
                                                    }
                                                ],
                                                "text": "life had started dealing him aces again"
                                            }
                                        ],
                                        "id": "m_en_gbus0005680.006",
                                        "semanticClasses": [
                                            {
                                                "id": "playing_card",
                                                "text": "Playing_Card"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "playing card with single spot on it, ranked as highest card in its suit in most card games"
                                        ]
                                    },
                                    {
                                        "definitions": [
                                            "a person who excels at a particular sport or other activity"
                                        ],
                                        "domainClasses": [
                                            {
                                                "id": "sport",
                                                "text": "Sport"
                                            }
                                        ],
                                        "examples": [
                                            {
                                                "text": "a motorcycle ace"
                                            }
                                        ],
                                        "id": "m_en_gbus0005680.010",
                                        "registers": [
                                            {
                                                "id": "informal",
                                                "text": "Informal"
                                            }
                                        ],
                                        "semanticClasses": [
                                            {
                                                "id": "sports_player",
                                                "text": "Sports_Player"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "person who excels at particular sport or other activity"
                                        ],
                                        "subsenses": [
                                            {
                                                "definitions": [
                                                    "a pilot who has shot down many enemy aircraft"
                                                ],
                                                "domainClasses": [
                                                    {
                                                        "id": "air_force",
                                                        "text": "Air_Force"
                                                    }
                                                ],
                                                "examples": [
                                                    {
                                                        "text": "a Battle of Britain ace"
                                                    }
                                                ],
                                                "id": "m_en_gbus0005680.011",
                                                "semanticClasses": [
                                                    {
                                                        "id": "aviator",
                                                        "text": "Aviator"
                                                    }
                                                ],
                                                "shortDefinitions": [
                                                    "pilot who has shot down many enemy aircraft"
                                                ]
                                            }
                                        ],
                                        "synonyms": [
                                            {
                                                "language": "en",
                                                "text": "expert"
                                            },
                                            {
                                                "language": "en",
                                                "text": "master"
                                            },
                                            {
                                                "language": "en",
                                                "text": "genius"
                                            },
                                            {
                                                "language": "en",
                                                "text": "virtuoso"
                                            },
                                            {
                                                "language": "en",
                                                "text": "maestro"
                                            },
                                            {
                                                "language": "en",
                                                "text": "professional"
                                            },
                                            {
                                                "language": "en",
                                                "text": "adept"
                                            },
                                            {
                                                "language": "en",
                                                "text": "past master"
                                            },
                                            {
                                                "language": "en",
                                                "text": "doyen"
                                            },
                                            {
                                                "language": "en",
                                                "text": "champion"
                                            },
                                            {
                                                "language": "en",
                                                "text": "star"
                                            },
                                            {
                                                "language": "en",
                                                "text": "winner"
                                            }
                                        ],
                                        "thesaurusLinks": [
                                            {
                                                "entry_id": "ace",
                                                "sense_id": "t_en_gb0000173.001"
                                            }
                                        ]
                                    },
                                    {
                                        "definitions": [
                                            "(in tennis and similar games) a service that an opponent is unable to return and thus wins a point"
                                        ],
                                        "domainClasses": [
                                            {
                                                "id": "tennis",
                                                "text": "Tennis"
                                            }
                                        ],
                                        "examples": [
                                            {
                                                "text": "Nadal banged down eight aces in the set"
                                            }
                                        ],
                                        "id": "m_en_gbus0005680.013",
                                        "semanticClasses": [
                                            {
                                                "id": "stroke",
                                                "text": "Stroke"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "(in tennis and similar games) service that opponent is unable to return and thus wins point"
                                        ],
                                        "subsenses": [
                                            {
                                                "definitions": [
                                                    "a hole in one"
                                                ],
                                                "domainClasses": [
                                                    {
                                                        "id": "golf",
                                                        "text": "Golf"
                                                    }
                                                ],
                                                "domains": [
                                                    {
                                                        "id": "golf",
                                                        "text": "Golf"
                                                    }
                                                ],
                                                "examples": [
                                                    {
                                                        "text": "his hole in one at the 15th was Senior's second ace as a professional"
                                                    }
                                                ],
                                                "id": "m_en_gbus0005680.014",
                                                "registers": [
                                                    {
                                                        "id": "informal",
                                                        "text": "Informal"
                                                    }
                                                ],
                                                "semanticClasses": [
                                                    {
                                                        "id": "golf_stroke",
                                                        "text": "Golf_Stroke"
                                                    }
                                                ],
                                                "shortDefinitions": [
                                                    "hole in one"
                                                ]
                                            }
                                        ]
                                    }
                                ]
                            }
                        ],
                        "language": "en-gb",
                        "lexicalCategory": {
                            "id": "noun",
                            "text": "Noun"
                        },
                        "phrases": [
                            {
                                "id": "an_ace_up_one%27s_sleeve",
                                "text": "an ace up one's sleeve"
                            },
                            {
                                "id": "hold_all_the_aces",
                                "text": "hold all the aces"
                            },
                            {
                                "id": "play_one%27s_ace",
                                "text": "play one's ace"
                            },
                            {
                                "id": "within_an_ace_of",
                                "text": "within an ace of"
                            }
                        ],
                        "text": "ace"
                    },
                    {
                        "entries": [
                            {
                                "homographNumber": "101",
                                "pronunciations": [
                                    {
                                        "audioFile": "https://audio.oxforddictionaries.com/en/mp3/ace_1_gb_1_abbr.mp3",
                                        "dialects": [
                                            "British English"
                                        ],
                                        "phoneticNotation": "IPA",
                                        "phoneticSpelling": "eɪs"
                                    }
                                ],
                                "senses": [
                                    {
                                        "definitions": [
                                            "very good"
                                        ],
                                        "examples": [
                                            {
                                                "text": "an ace swimmer"
                                            },
                                            {
                                                "notes": [
                                                    {
                                                        "text": "as exclamation",
                                                        "type": "grammaticalNote"
                                                    }
                                                ],
                                                "text": "Ace! You've done it!"
                                            }
                                        ],
                                        "id": "m_en_gbus0005680.016",
                                        "registers": [
                                            {
                                                "id": "informal",
                                                "text": "Informal"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "very good"
                                        ],
                                        "synonyms": [
                                            {
                                                "language": "en",
                                                "text": "excellent"
                                            },
                                            {
                                                "language": "en",
                                                "text": "very good"
                                            },
                                            {
                                                "language": "en",
                                                "text": "first-rate"
                                            },
                                            {
                                                "language": "en",
                                                "text": "first-class"
                                            },
                                            {
                                                "language": "en",
                                                "text": "marvellous"
                                            },
                                            {
                                                "language": "en",
                                                "text": "wonderful"
                                            },
                                            {
                                                "language": "en",
                                                "text": "magnificent"
                                            },
                                            {
                                                "language": "en",
                                                "text": "outstanding"
                                            },
                                            {
                                                "language": "en",
                                                "text": "superlative"
                                            },
                                            {
                                                "language": "en",
                                                "text": "formidable"
                                            },
                                            {
                                                "language": "en",
                                                "text": "virtuoso"
                                            },
                                            {
                                                "language": "en",
                                                "text": "masterly"
                                            },
                                            {
                                                "language": "en",
                                                "text": "expert"
                                            },
                                            {
                                                "language": "en",
                                                "text": "champion"
                                            },
                                            {
                                                "language": "en",
                                                "text": "fine"
                                            },
                                            {
                                                "language": "en",
                                                "text": "consummate"
                                            },
                                            {
                                                "language": "en",
                                                "text": "skilful"
                                            },
                                            {
                                                "language": "en",
                                                "text": "adept"
                                            }
                                        ],
                                        "thesaurusLinks": [
                                            {
                                                "entry_id": "ace",
                                                "sense_id": "t_en_gb0000173.002"
                                            }
                                        ]
                                    }
                                ]
                            }
                        ],
                        "language": "en-gb",
                        "lexicalCategory": {
                            "id": "adjective",
                            "text": "Adjective"
                        },
                        "phrases": [
                            {
                                "id": "an_ace_up_one%27s_sleeve",
                                "text": "an ace up one's sleeve"
                            },
                            {
                                "id": "hold_all_the_aces",
                                "text": "hold all the aces"
                            },
                            {
                                "id": "play_one%27s_ace",
                                "text": "play one's ace"
                            },
                            {
                                "id": "within_an_ace_of",
                                "text": "within an ace of"
                            }
                        ],
                        "text": "ace"
                    },
                    {
                        "entries": [
                            {
                                "grammaticalFeatures": [
                                    {
                                        "id": "transitive",
                                        "text": "Transitive",
                                        "type": "Subcategorization"
                                    }
                                ],
                                "homographNumber": "102",
                                "pronunciations": [
                                    {
                                        "audioFile": "https://audio.oxforddictionaries.com/en/mp3/ace_1_gb_1_abbr.mp3",
                                        "dialects": [
                                            "British English"
                                        ],
                                        "phoneticNotation": "IPA",
                                        "phoneticSpelling": "eɪs"
                                    }
                                ],
                                "senses": [
                                    {
                                        "definitions": [
                                            "(in tennis and similar games) serve an ace against (an opponent)"
                                        ],
                                        "domainClasses": [
                                            {
                                                "id": "tennis",
                                                "text": "Tennis"
                                            }
                                        ],
                                        "examples": [
                                            {
                                                "text": "he can ace opponents with serves of no more than 62 mph"
                                            }
                                        ],
                                        "id": "m_en_gbus0005680.020",
                                        "registers": [
                                            {
                                                "id": "informal",
                                                "text": "Informal"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "(in tennis and similar games) serve ace against"
                                        ],
                                        "subsenses": [
                                            {
                                                "definitions": [
                                                    "score an ace on (a hole) or with (a shot)"
                                                ],
                                                "domainClasses": [
                                                    {
                                                        "id": "golf",
                                                        "text": "Golf"
                                                    }
                                                ],
                                                "domains": [
                                                    {
                                                        "id": "golf",
                                                        "text": "Golf"
                                                    }
                                                ],
                                                "examples": [
                                                    {
                                                        "text": "there was a prize for the first player to ace the hole"
                                                    }
                                                ],
                                                "id": "m_en_gbus0005680.026",
                                                "shortDefinitions": [
                                                    "score ace on hole or with"
                                                ]
                                            }
                                        ]
                                    },
                                    {
                                        "definitions": [
                                            "achieve high marks in (a test or exam)"
                                        ],
                                        "examples": [
                                            {
                                                "text": "I aced my grammar test"
                                            }
                                        ],
                                        "id": "m_en_gbus0005680.028",
                                        "regions": [
                                            {
                                                "id": "north_american",
                                                "text": "North_American"
                                            }
                                        ],
                                        "registers": [
                                            {
                                                "id": "informal",
                                                "text": "Informal"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "achieve high marks in"
                                        ],
                                        "subsenses": [
                                            {
                                                "definitions": [
                                                    "outdo someone in a competitive situation"
                                                ],
                                                "examples": [
                                                    {
                                                        "text": "the magazine won an award, acing out its rivals"
                                                    }
                                                ],
                                                "id": "m_en_gbus0005680.029",
                                                "notes": [
                                                    {
                                                        "text": "\"ace someone out\"",
                                                        "type": "wordFormNote"
                                                    }
                                                ],
                                                "shortDefinitions": [
                                                    "outdo someone in competitive situation"
                                                ]
                                            }
                                        ]
                                    }
                                ]
                            }
                        ],
                        "language": "en-gb",
                        "lexicalCategory": {
                            "id": "verb",
                            "text": "Verb"
                        },
                        "phrases": [
                            {
                                "id": "an_ace_up_one%27s_sleeve",
                                "text": "an ace up one's sleeve"
                            },
                            {
                                "id": "hold_all_the_aces",
                                "text": "hold all the aces"
                            },
                            {
                                "id": "play_one%27s_ace",
                                "text": "play one's ace"
                            },
                            {
                                "id": "within_an_ace_of",
                                "text": "within an ace of"
                            }
                        ],
                        "text": "ace"
                    }
                ],
                "type": "headword",
                "word": "ace"
            },
            {
                "id": "ace",
                "language": "en-gb",
                "lexicalEntries": [
                    {
                        "entries": [
                            {
                                "etymologies": [
                                    "early 21st century: abbreviation of asexual, with alteration of spelling on the model of ace"
                                ],
                                "homographNumber": "200",
                                "pronunciations": [
                                    {
                                        "audioFile": "https://audio.oxforddictionaries.com/en/mp3/ace_1_gb_1_abbr.mp3",
                                        "dialects": [
                                            "British English"
                                        ],
                                        "phoneticNotation": "IPA",
                                        "phoneticSpelling": "eɪs"
                                    }
                                ],
                                "senses": [
                                    {
                                        "definitions": [
                                            "a person who has no sexual feelings or desires"
                                        ],
                                        "domainClasses": [
                                            {
                                                "id": "sex",
                                                "text": "Sex"
                                            }
                                        ],
                                        "examples": [
                                            {
                                                "text": "both asexual, they have managed to connect with other aces offline"
                                            }
                                        ],
                                        "id": "m_en_gbus1190638.004",
                                        "semanticClasses": [
                                            {
                                                "id": "type_of_person",
                                                "text": "Type_Of_Person"
                                            }
                                        ],
                                        "shortDefinitions": [
                                            "asexual person"
                                        ]
                                    }
                                ]
                            }
                        ],
                        "language": "en-gb",
                        "lexicalCategory": {
                            "id": "noun",
                            "text": "Noun"
                        },
                        "text": "ace"
                    },
                    {
                        "entries": [
                            {
                                "homographNumber": "201",
                                "pronunciations": [
                                    {
                                        "audioFile": "https://audio.oxforddictionaries.com/en/mp3/ace_1_gb_1_abbr.mp3",
                                        "dialects": [
                                            "British English"
                                        ],
                                        "phoneticNotation": "IPA",
                                        "phoneticSpelling": "eɪs"
                                    }
                                ],
                                "senses": [
                                    {
                                        "definitions": [
                                            "(of a person) having no sexual feelings or desires; asexual"
                                        ],
                                        "domainClasses": [
                                            {
                                                "id": "sex",
                                                "text": "Sex"
                                            }
                                        ],
                                        "examples": [
                                            {
                                                "text": "I didn't realize that I was ace for a long time"
                                            }
                                        ],
                                        "id": "m_en_gbus1190638.006",
                                        "shortDefinitions": [
                                            "asexual"
                                        ]
                                    }
                                ]
                            }
                        ],
                        "language": "en-gb",
                        "lexicalCategory": {
                            "id": "adjective",
                            "text": "Adjective"
                        },
                        "text": "ace"
                    }
                ],
                "type": "headword",
                "word": "ace"
            }
        ],
        "word": "ace"
    }
    RESPONSE;

    const ERROR_RESPONSE = <<<'ERROR_RESPONSE'
    {
        "error": "No entry found matching supplied source_lang, word and provided filters"
    }
    ERROR_RESPONSE;

    /**
     * @test
     */
    public function we_can_perform_a_entries()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects($this->once())->method('get')->willReturn(json_decode(self::RESPONSE, true));
        $api = new EntriesApi($client);
        $results = $api->get('languege', 'word');
        $this->assertIsArray($results);
        $this->assertInstanceOf(Entry::class, $results[0]);
        $this->assertInstanceOf(LexicalEntry::class, $results[0]->lexicalEntries[0]);
        $this->assertInstanceOf(Pronunciation::class, $results[0]->lexicalEntries[0]->pronunciations[0]);
        $this->assertInstanceOf(Sense::class, $results[0]->lexicalEntries[0]->senses[0]);
    }

    /**
     * @test
     */
    public function we_can_not_found_a_entries()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects($this->once())->method('get')->willReturn(json_decode(self::ERROR_RESPONSE, true));
        $api = new EntriesApi($client);
        $results = $api->get('lang', 'bad_word');
        $this->assertIsArray($results);
    }

    /**
     * @test
     */
    public function we_throw_valid_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willThrowException(
            $this->createMock(ApiException::class)
        );
        $api = new EntriesApi($client);
        $this->expectException(ApiException::class);
        $api->get('bad_request', 'bad_request');
    }
}
