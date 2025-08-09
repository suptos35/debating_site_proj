<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Reference;

class CreateDebatePosts extends Command
{
    protected $signature = 'create:debate-posts';
    protected $description = 'Create debate posts with pro/con arguments and references';

    public function handle()
    {
        // First, let's check what users and categories exist
        $this->info('Existing users:');
        $users = User::all();
        foreach($users as $user) {
            $this->line("- {$user->name} (ID: {$user->id})");
        }

        $this->info("\nExisting categories:");
        $categories = Category::all();
        foreach($categories as $category) {
            $this->line("- {$category->name} (ID: {$category->id})");
        }

        // Create some random users if we don't have enough
        if($users->count() < 10) {
            $this->info("\nCreating random users...");
            $userNames = [
                'Climate Activist Raha', 'Policy Expert Ahmed', 'Environmental Lawyer Nasir',
                'Economic Analyst Fatima', 'Social Worker Khalid', 'Student Leader Aisha',
                'Energy Researcher Jamal', 'Labor Rights Advocate Rashida', 'Academic Dr. Rahman',
                'Human Rights Worker Sabrina', 'Industrial Engineer Tariq', 'NGO Director Shahana'
            ];

            foreach($userNames as $name) {
                if(!User::where('name', $name)->exists()) {
                    User::create([
                        'name' => $name,
                        'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                        'password' => bcrypt('password'),
                        'role' => 'user'
                    ]);
                    $this->line("Created user: {$name}");
                }
            }
        }

        // Create categories if they don't exist
        $categoryData = [
            ['name' => 'Climate Policy', 'description' => 'Discussions about climate change policies and environmental issues'],
            ['name' => 'Energy & Infrastructure', 'description' => 'Debates about energy sources and infrastructure development'],
            ['name' => 'Labor Rights', 'description' => 'Worker rights, workplace conditions, and labor policies'],
            ['name' => 'Education Policy', 'description' => 'University policies, student life, and educational reforms'],
        ];

        foreach($categoryData as $catData) {
            if(!Category::where('name', $catData['name'])->exists()) {
                Category::create($catData);
                $this->line("Created category: {$catData['name']}");
            }
        }

        // Refresh our collections
        $users = User::all();
        $categories = Category::all();

        // Now create the debate posts
        $debates = [
            [
                'title' => 'Should Bangladesh Accept More Climate Refugees from Neighboring Countries?',
                'category' => 'Climate Policy',
                'content' => 'With climate change driving displacement across South Asia, should Bangladesh open its doors to more climate refugees from neighboring countries? This complex issue involves humanitarian concerns, resource constraints, and regional stability.',
                'pros' => [
                    [
                        'title' => 'Moral Leadership: Hosting Myanmar\'s Rohingya (1M+) positions Bangladesh as a climate justice champion',
                        'content' => 'Bangladesh has already demonstrated extraordinary humanitarian leadership by hosting over 1 million Rohingya refugees from Myanmar. This positions the country as a global leader in climate justice and refugee protection, setting a moral example for other nations facing similar challenges.',
                        'url' => 'https://thediplomaticinsight.com/bangladesh-hosts-1-million-rohingya-refugees/'
                    ],
                    [
                        'title' => 'International Aid: Could unlock $2B+ in climate grants',
                        'content' => 'Accepting more climate refugees could unlock significant international funding, particularly from the EU\'s 2024 "Loss and Damage" fund and other climate adaptation grants. This financial support could exceed $2 billion and help Bangladesh build better infrastructure for both refugees and citizens.',
                        'url' => ''
                    ]
                ],
                'cons' => [
                    [
                        'title' => 'Resource Strain: 2025 heatwave caused water riots in Cox\'s Bazar',
                        'content' => 'The 2025 heatwave has already pushed Bangladesh\'s resources to the breaking point, with water riots erupting in Cox\'s Bazar refugee camps. Adding more refugees could trigger a humanitarian crisis, overwhelming already strained infrastructure and services.',
                        'url' => ''
                    ],
                    [
                        'title' => 'Security Threats: Islamist groups exploited Rohingya camps',
                        'content' => 'Security concerns are mounting as Islamist groups have successfully exploited Rohingya refugee camps, leading to police raids in 2024. Accepting more refugees without proper security measures could worsen these threats and destabilize the region further.',
                        'url' => 'https://www.crisisgroup.org/asia/south-east-asia/myanmar-bangladesh/348-bangladeshmyanmar-dangers-rohingya-insurgency'
                    ]
                ]
            ],
            [
                'title' => 'Should Bangladesh Build Mega-Coal Plants Despite Climate Risks?',
                'category' => 'Energy & Infrastructure',
                'content' => 'As Bangladesh pursues rapid industrialization, the debate over mega-coal plants intensifies. While they promise energy security and economic growth, environmental costs and climate commitments raise serious questions about this energy strategy.',
                'pros' => [
                    [
                        'title' => 'Energy Security: Matarbari plant (1,200MW) reduced 2025 load-shedding by 40%',
                        'content' => 'The Matarbari coal power plant has significantly improved Bangladesh\'s energy security, providing 1,200MW of reliable power and reducing load-shedding by 40% in industrial zones during 2025. This reliable energy supply is crucial for maintaining industrial competitiveness.',
                        'url' => 'https://en.prothomalo.com/bangladesh/ajyzw41gcr'
                    ],
                    [
                        'title' => 'Cheap Power: Electricity at $0.08/kWh vs. $0.15 for solar',
                        'content' => 'Coal-generated electricity costs only $0.08 per kWh compared to $0.15 for solar power, making it nearly twice as cost-effective. This price advantage is critical for maintaining export competitiveness in the global market, especially for energy-intensive industries.',
                        'url' => ''
                    ]
                ],
                'cons' => [
                    [
                        'title' => 'Ecocide Threat: Sundarbans mangrove erosion accelerated (15% in 2024)',
                        'content' => 'Coal-ash pollution has accelerated the erosion of the Sundarbans mangrove forest, with a devastating 15% loss in 2024 alone. This threatens one of the world\'s most important ecosystems and Bangladesh\'s natural defense against cyclones and sea-level rise.',
                        'url' => ''
                    ],
                    [
                        'title' => 'Climate Costs: $6B/year flood damage threatens $500M green climate funds',
                        'content' => 'Bangladesh faces $6 billion annually in flood damage according to the World Bank\'s 2025 report. Continuing coal projects jeopardizes access to $500 million in green climate funds, potentially leaving the country without crucial adaptation financing.',
                        'url' => 'https://www.tbsnews.net/bangladesh/energy/coal-shortage-forces-matarbari-power-plant-cut-production-1114246'
                    ]
                ]
            ],
            [
                'title' => 'Should Garment Factories Implement 4-Day Workweeks Despite Production Targets?',
                'category' => 'Labor Rights',
                'content' => 'Bangladesh\'s garment industry, the backbone of its economy, faces pressure to improve working conditions while meeting demanding production schedules. The 4-day workweek proposal has sparked intense debate about worker welfare versus economic competitiveness.',
                'pros' => [
                    [
                        'title' => 'Productivity Boost: DBL Group trial saw 22% higher output due to reduced fatigue',
                        'content' => 'The 2025 DBL Group trial demonstrated that a 4-day workweek actually increased productivity by 22% due to reduced worker fatigue and improved focus. This challenges the assumption that fewer working days necessarily mean lower output.',
                        'url' => 'https://www.thedailystar.net/tech-startup/news/more-countries-are-moving-four-day-workweeks-can-we-ever-2964746'
                    ],
                    [
                        'title' => 'Global Compliance: H&M cancelled orders from 5 factories over "worker burnout"',
                        'content' => 'International buyers are increasingly prioritizing worker welfare, with H&M cancelling orders from 5 factories in 2024 due to worker burnout concerns. Implementing 4-day workweeks could help maintain crucial international partnerships and contracts.',
                        'url' => ''
                    ]
                ],
                'cons' => [
                    [
                        'title' => 'Export Penalties: $28M in late-delivery fines imposed on Epic Group',
                        'content' => 'The Epic Group faced $28 million in late-delivery fines in 2025 when production schedules shifted to accommodate worker welfare measures. These penalties demonstrate the real financial risks of disrupting established production timelines.',
                        'url' => ''
                    ],
                    [
                        'title' => 'Wage Cuts: Workers fear salary reductions to offset fewer days',
                        'content' => 'Workers are concerned that a 4-day workweek will lead to proportional salary cuts, as seen in the 2024 Snowtex protests. Many workers depend on overtime pay and fear that fewer working days will significantly impact their already modest incomes.',
                        'url' => ''
                    ]
                ]
            ],
            [
                'title' => 'Should Public Universities Ban Political Parties on Campus?',
                'category' => 'Education Policy',
                'content' => 'Student politics has long been a feature of Bangladesh\'s public universities, but growing concerns about violence and academic disruption have sparked calls for political party bans. This debate touches on democracy, safety, and educational quality.',
                'pros' => [
                    [
                        'title' => 'Academic Focus: DU\'s 2024 class attendance rose 37% after temporary party bans',
                        'content' => 'Dhaka University saw a remarkable 37% increase in class attendance following temporary political party bans in 2024. This suggests that political activities were significantly disrupting the academic environment and student focus on education.',
                        'url' => 'https://www.tbsnews.net/thoughts/should-student-politics-be-banned-bangladeshi-universities-1089181'
                    ],
                    [
                        'title' => 'Violence Reduction: 90% drop in campus clashes at Jahangirnagar University',
                        'content' => 'Jahangirnagar University experienced a 90% reduction in campus clashes after implementing political party bans post-2024. This dramatic decrease in violence has created a safer learning environment for students and faculty.',
                        'url' => ''
                    ]
                ],
                'cons' => [
                    [
                        'title' => 'Protest Suppression: Banned anti-quota movement rallies led to police crackdowns',
                        'content' => 'The ban on political parties has led to the suppression of legitimate student protests, including anti-quota movement rallies at RUET in 2025. This raises concerns about students\' democratic rights and their ability to voice legitimate grievances.',
                        'url' => ''
                    ],
                    [
                        'title' => 'Career Harm: Student politics builds leadership networks critical for job placements',
                        'content' => 'Student politics has traditionally served as a pathway to leadership development and professional networking. Banning political activities could harm students\' career prospects by eliminating these crucial networking opportunities and leadership training.',
                        'url' => 'https://www.researchgate.net/publication/353197847_How_important_are_political_skills_for_career_success_A_systematic_review_and_meta-analysis'
                    ]
                ]
            ],
            [
                'title' => 'Is the Private University Fee Hike Justifiable Amid Economic Crisis?',
                'category' => 'Education Policy',
                'content' => 'As Bangladesh faces economic challenges, private universities have implemented significant fee increases, sparking debate about educational accessibility and quality. Students and families struggle with rising costs while universities cite infrastructure and faculty needs.',
                'pros' => [
                    [
                        'title' => 'Quality Maintenance: IUB\'s 35% fee increase funded AI labs, ranking it #1 private uni',
                        'content' => 'Independent University of Bangladesh\'s 35% fee increase directly funded state-of-the-art AI laboratories, helping it achieve the #1 ranking among private universities in 2025. This demonstrates how increased fees can translate into tangible educational improvements.',
                        'url' => ''
                    ],
                    [
                        'title' => 'Faculty Retention: NSU stopped 50% professor exodus to Malaysia with salary hikes',
                        'content' => 'North South University successfully halted a massive 50% professor exodus to Malaysia by using fee revenue to fund competitive salary increases. Retaining quality faculty is essential for maintaining educational standards and student outcomes.',
                        'url' => ''
                    ]
                ],
                'cons' => [
                    [
                        'title' => 'Elitism: Only 5% of rural students can now afford private universities',
                        'content' => 'A 2024 SUST study revealed that only 5% of rural students can now afford private university education following fee hikes. This creates an educational divide that reinforces socioeconomic inequalities and limits opportunities for talented but economically disadvantaged students.',
                        'url' => ''
                    ],
                    [
                        'title' => 'Debt Traps: 200% rise in student loan defaults at East West University',
                        'content' => 'East West University saw a 200% increase in student loan defaults in 2025, indicating that fee hikes are pushing students into unsustainable debt. This financial burden can have long-term consequences for graduates and their families.',
                        'url' => 'https://www.aljazeera.com/news/2015/9/13/bangladesh-students-protest-education-tax'
                    ]
                ]
            ]
        ];

        foreach($debates as $debateData) {
            $this->info("\nCreating debate: {$debateData['title']}");

            // Find the category
            $category = $categories->where('name', $debateData['category'])->first();

            // Create main post
            $randomUser = $users->random();
            $mainPost = Post::create([
                'title' => $debateData['title'],
                'excerpt' => substr($debateData['content'], 0, 200) . '...',
                'content' => $debateData['content'],
                'user_id' => $randomUser->id,
                'type' => 'question',
                'like_count' => rand(5, 50)
            ]);

            // Attach category
            if($category) {
                $mainPost->categories()->attach($category->id);
            }

            $this->line("  Created main post (ID: {$mainPost->id}) by {$randomUser->name}");

            // Create PRO arguments
            foreach($debateData['pros'] as $proData) {
                $randomUser = $users->random();
                $proPost = Post::create([
                    'title' => $proData['title'],
                    'excerpt' => substr($proData['content'], 0, 200) . '...',
                    'content' => $proData['content'],
                    'parent_id' => $mainPost->id,
                    'user_id' => $randomUser->id,
                    'type' => 'pro',
                    'like_count' => rand(2, 25)
                ]);

                // Add reference if URL provided
                if(!empty($proData['url'])) {
                    Reference::create([
                        'post_id' => $proPost->id,
                        'url' => $proData['url'],
                        'title' => 'Reference for ' . $proData['title'],
                        'description' => 'Supporting reference for this argument'
                    ]);
                    $this->line("    Created PRO argument with reference by {$randomUser->name}");
                } else {
                    $this->line("    Created PRO argument by {$randomUser->name}");
                }
            }

            // Create CON arguments
            foreach($debateData['cons'] as $conData) {
                $randomUser = $users->random();
                $conPost = Post::create([
                    'title' => $conData['title'],
                    'excerpt' => substr($conData['content'], 0, 200) . '...',
                    'content' => $conData['content'],
                    'parent_id' => $mainPost->id,
                    'user_id' => $randomUser->id,
                    'type' => 'con',
                    'like_count' => rand(2, 25)
                ]);

                // Add reference if URL provided
                if(!empty($conData['url'])) {
                    Reference::create([
                        'post_id' => $conPost->id,
                        'url' => $conData['url'],
                        'title' => 'Reference for ' . $conData['title'],
                        'description' => 'Supporting reference for this argument'
                    ]);
                    $this->line("    Created CON argument with reference by {$randomUser->name}");
                } else {
                    $this->line("    Created CON argument by {$randomUser->name}");
                }
            }
        }

        $this->info("\n✅ All debate posts created successfully!");
        return 0;
    }
}
