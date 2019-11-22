<?php

namespace spec\XmlTv;

use XmlTv\Tv;
use XmlTv\XmlElement;
use XmlTv\XmlTv;
use PhpSpec\ObjectBehavior;

class XmlTvSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(XmlTv::class);
    }

    function it_generates_an_xml_file_from_an_empty_tv_object()
    {
        $xml = file_get_contents(__DIR__.'/../epg-empty.xml');

        $this->generate(new Tv(), false)->shouldReturn($xml);
    }

    function it_generates_an_xml_file()
    {
        $xml = file_get_contents(__DIR__.'/../epg.xml');
        $date = gmdate(Tv::DATE_FORMAT, 100000);

        $tv = new Tv($date, 'http://thesource.test/');

        $channel = new Tv\Channel('test');
        $channel->addDisplayName(new Tv\Elements\DisplayName('test', 'en'));
        $channel->addDisplayName(new Tv\Elements\DisplayName('test', 'de'));
        $channel->addIcon(new Tv\Elements\Icon('http://foo.bar/img.png', 200, 200));
        $channel->addUrl(new Tv\Elements\Url('http://foo.bar/'));

        $programme = new Tv\Programme('test', '1', '2');
        $programme->addTitle(new Tv\Elements\Title('title'));
        $programme->addSubTitle(new Tv\Elements\SubTitle('subtitle'));
        $programme->addDescription(new Tv\Elements\Desc('desc'));
        $credits = new Tv\Elements\Credits();
        $credits->director[] = new Tv\Elements\Credits\Director('Michael May');
        $credits->actor[] = new Tv\Elements\Credits\Actor('Com Truise', 'Lead');
        $credits->actor[] = new Tv\Elements\Credits\Actor('Foo Bar', 'Supporting');
        $credits->writer[] = new Tv\Elements\Credits\Writer('Wri Te');
        $credits->adapter[] = new Tv\Elements\Credits\Adapter('Adap Ter');
        $credits->producer[] = new Tv\Elements\Credits\Producer('Pro Ducer');
        $credits->composer[] = new Tv\Elements\Credits\Composer('Com Poser');
        $credits->editor[] = new Tv\Elements\Credits\Editor('Edi Thor');
        $credits->presenter[] = new Tv\Elements\Credits\Presenter('Pre Senter');
        $credits->commentator[] = new Tv\Elements\Credits\Commentator('Com Mentator');
        $credits->guest[] = new Tv\Elements\Credits\Guest('Lan Stee');
        $programme->addCredits($credits);
        $programme->date = new Tv\Elements\Date('1999');
        $programme->addCategory(new Tv\Elements\Category('category'));
        $programme->addKeyword(new Tv\Elements\Keyword('keyword'));
        $programme->language = new Tv\Elements\Language('de');
        $programme->origLanguage = new Tv\Elements\OrigLanguage('fr');
        $programme->length = new Tv\Elements\Length('200', Tv\Elements\Length\Unit::MINUTES);
        $programme->addIcon(new Tv\Elements\Icon('http://foo.bar/x.png', 100, 100));
        $programme->addUrl(new Tv\Elements\Url('http://programme.test/'));
        $programme->addCountry(new Tv\Elements\Country('France', 'en'));
        $programme->addEpisodeNum(new Tv\Elements\EpisodeNum('1'));
        $programme->video = new Tv\Elements\Video('yes', 'yes', '4:3', 'UHD');
        $programme->audio = new Tv\Elements\Audio('yes', 'stereo');
        $programme->previouslyShown = new Tv\Elements\PreviouslyShown('', 'foo');
        $programme->premiere = new Tv\Elements\Premiere('Premiered on PHPTV');
        $programme->lastChance = new Tv\Elements\LastChance('Get it while it is hot!', 'en');
        $programme->new = new Tv\Elements\NewProgramme();
        $programme->addSubtitles(new Tv\Elements\Subtitles('en', Tv\Elements\Subtitles\Type::ONSCREEN));
        $rating = new Tv\Elements\Rating('Good');
        $rating->addIcon(new Tv\Elements\Icon('http://foo.bar/icon.png', 500, 400));
        $programme->addRating($rating);
        $programme->addStarRating(new Tv\Elements\StarRating('5'));
        $programme->addReview(new Tv\Elements\Review('Very nice!', Tv\Elements\Review\Type::TEXT));

        $tv->addChannel($channel);
        $tv->addProgramme($programme);

        $this->generate($tv, false)->shouldReturn($xml);
    }

    function it_throws_if_the_generated_xml_does_not_validate()
    {
        $this->shouldThrow('XmlTv\Exceptions\ValidationException')->duringGenerate(new InvalidTv(), true);
    }

    function it_triggers_a_warning_if_an_element_cannot_be_serialized()
    {
        $this->shouldTrigger(E_USER_WARNING)->duringGenerate(new UnserializableChild(), false);
    }
}

class InvalidTv extends Tv
{
    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('tv'))
            ->withAttribute('invalid', 'foo');
    }
}

class UnserializableChild extends Tv
{
    public function xmlSerialize(): XmlElement
    {
        return (new XmlElement('tv'))
            ->withOptionalChild(new \stdClass());
    }
}
