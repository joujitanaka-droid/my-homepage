<?php

get_header();

$slowth_media = jpf_get_slowth_media_urls();
?>
<main id="content" class="neve-main">
    <div class="container single-page-container">
        <div class="row">
            <div class="nv-single-page-wrap col">
                <div class="nv-page-title-wrap nv-big-title">
                    <div class="nv-page-title">
                        <h1>SlowTH</h1>
                    </div>
                </div>
                <div class="nv-content-wrap entry-content">
                    <section id="intro" class="hero section">
                        <h2>What is the AI robot SlowTH?</h2>
                        <p>SlowTH is a next-generation AI robot solution that automates repetitive work on the manufacturing floor.</p>
                        <p>No communication with existing equipment is required, setup can be completed in about three minutes from a tablet, and the system helps solve labor shortages while improving productivity.</p>
                    </section>

                    <section id="gallery" class="section">
                        <h2>Machine Photos</h2>
                        <p>These are actual installation photos of SlowTH in operation. Please review the real-world setup image and operating examples.</p>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['gallery'][0] ); ?>" alt="SlowTH machine photo 1" class="gallery-image">
                            </div>
                            <div class="gallery-item">
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['gallery'][1] ); ?>" alt="SlowTH machine photo 2" class="gallery-image">
                            </div>
                            <div class="gallery-item">
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['gallery'][2] ); ?>" alt="SlowTH machine photo 3" class="gallery-image">
                            </div>
                        </div>
                    </section>

                    <section id="video" class="section section-alt">
                        <h2>See SlowTH in Action</h2>
                        <p>The videos below show real operating scenes of SlowTH.</p>
                        <div class="video-grid">
                            <div class="video-wrapper">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/DPyeEMgBjm8" title="SlowTH demo video 4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/wZYY9ClGzKc" title="SlowTH demo video 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/IcIDjk-MbUY" title="SlowTH demo video 6" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/tr5EP9SzHzc" title="SlowTH demo video 7" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/ZRmHYVl0xQU" title="SlowTH demo video 8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/VqPr4ZMFhcs" title="SlowTH demo video 9" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/HHPMZBQW7zQ" title="SlowTH demo video 10" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>

                    <section id="features" class="section">
                        <h2>Key Features</h2>
                        <div class="feature-list">
                            <div class="feature-item">
                                <h3>&#x1f527; No integration with existing equipment required</h3>
                                <p>Complex linkage with an existing production system is not necessary. SlowTH works as a standalone solution, making installation simple and stable.</p>
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['features'][0] ); ?>" alt="Standalone operation image" class="feature-image">
                            </div>
                            <div class="feature-item">
                                <h3>&#x26a1; Setup in about 3 minutes</h3>
                                <p>Operators can complete setup from a tablet in only a few minutes. No advanced technical knowledge is required.</p>
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['features'][1] ); ?>" alt="Quick setup image" class="feature-image">
                            </div>
                            <div class="feature-item">
                                <h3>&#x1f465; Supports labor shortage countermeasures</h3>
                                <p>By automating simple and repetitive work, SlowTH allows valuable human resources to focus on higher-value tasks.</p>
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['features'][2] ); ?>" alt="Labor shortage support image" class="feature-image">
                            </div>
                        </div>
                    </section>

                    <section id="technology" class="section section-alt">
                        <h2>Technical Capability</h2>
                        <div class="tech-comparison">
                            <div class="comparison-block">
                                <h3>Typical AI robots</h3>
                                <ul>
                                    <li>Specialized for a single task type</li>
                                    <li>Difficult to handle complex decisions</li>
                                    <li>Weak against environmental changes</li>
                                    <li>High introduction cost</li>
                                </ul>
                            </div>
                            <div class="comparison-block">
                                <h3>SlowTH multi-step AI</h3>
                                <ul>
                                    <li>Supports multiple task patterns</li>
                                    <li>Capable of more complex decision making</li>
                                    <li>Adapts to environmental changes</li>
                                    <li>Keeps introduction cost low</li>
                                </ul>
                            </div>
                        </div>

                        <div class="ai-process">
                            <h3>AI Processing Flow</h3>
                            <div class="process-steps">
                                <div class="step">
                                    <div class="step-number">1</div>
                                    <p>Recognition</p>
                                    <span>Analyzes the current operating situation</span>
                                </div>
                                <div class="step">
                                    <div class="step-number">2</div>
                                    <p>Decision</p>
                                    <span>Selects the best action from multiple patterns</span>
                                </div>
                                <div class="step">
                                    <div class="step-number">3</div>
                                    <p>Control</p>
                                    <span>Executes precise motion control</span>
                                </div>
                                <div class="step">
                                    <div class="step-number">4</div>
                                    <p>Verification</p>
                                    <span>Checks and reports completion status</span>
                                </div>
                            </div>
                            <div class="process-image">
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['process'] ); ?>" alt="AI processing flow" class="process-screenshot">
                            </div>
                        </div>
                    </section>

                    <section id="benefits" class="section">
                        <h2>Benefits</h2>
                        <ul>
                            <li><strong>Higher efficiency:</strong> Reduces manual work and shortens processing time.</li>
                            <li><strong>Lower cost:</strong> Improves management efficiency by reducing labor cost.</li>
                            <li><strong>Better quality:</strong> Stable AI processing helps reduce human error.</li>
                            <li><strong>Scalability:</strong> Flexible expansion and adjustment based on your operation.</li>
                            <li><strong>24-hour operation:</strong> Supports continuous work day and night.</li>
                            <li><strong>Easy introduction:</strong> No complicated setup process is required.</li>
                        </ul>
                    </section>

                    <section id="cases" class="section">
                        <h2>Use Cases</h2>
                        <div class="cases-container">
                            <div class="case-item">
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['cases'][0] ); ?>" alt="Manufacturing case study" class="case-image">
                                <h3>Case 1: Manufacturer A</h3>
                                <p><strong>Task:</strong> Inspection, sorting and alignment of multiple part types</p>
                                <p><strong>Challenge:</strong> Skilled workers were fixed to visually demanding sorting work</p>
                                <p><strong>Results:</strong></p>
                                <ul class="case-details">
                                    <li>70% reduction in working time</li>
                                    <li>About 1,400 labor hours reduced per year</li>
                                    <li>90% reduction in human error</li>
                                    <li>Initial investment recovered in around 16 months</li>
                                    <li>Night-time unmanned operation doubled capacity</li>
                                </ul>
                            </div>
                            <div class="case-item">
                                <img decoding="async" src="<?php echo esc_url( $slowth_media['cases'][1] ); ?>" alt="Logistics case study" class="case-image">
                                <h3>Case 2: Logistics Company B</h3>
                                <p><strong>Task:</strong> Automatic sorting and picking of multiple product types</p>
                                <p><strong>Challenge:</strong> Manual sorting caused chronic delivery delays</p>
                                <p><strong>Results:</strong></p>
                                <ul class="case-details">
                                    <li>5x faster processing speed</li>
                                    <li>24-hour automated operation</li>
                                    <li>99% reduction in shipping delays</li>
                                    <li>Inventory loss improved from 0.5% to 0.05%</li>
                                    <li>Higher customer satisfaction</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <section id="faq" class="section section-alt">
                        <h2>FAQ</h2>
                        <div class="faq-container">
                            <div class="faq-item">
                                <h4>Q. Can SlowTH connect with an existing system?</h4>
                                <p>A. Basic operation does not require modification of your existing equipment. If API integration is necessary, we can discuss custom support.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Q. What industries is it suitable for?</h4>
                                <p>A. It is mainly used for simple and repetitive work in manufacturing and logistics, including sorting, alignment, picking and inspection.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Q. How long does introduction take?</h4>
                                <p>A. A standard project usually takes about 3 to 6 months, depending on the required scope and customization.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Q. Is employee training required?</h4>
                                <p>A. The interface is designed for intuitive tablet operation. Basic operation training is provided by our team.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Q. What about maintenance and support?</h4>
                                <p>A. After installation, maintenance and support are handled by our dedicated team.</p>
                            </div>
                            <div class="faq-item">
                                <h4>Q. What is the running cost?</h4>
                                <p>A. Running cost is significantly lower than maintaining the same repetitive work fully by manual labor. Detailed estimates are available on request.</p>
                            </div>
                        </div>
                    </section>

                    <section id="contact" class="section">
                        <h2>Talk to Us About Introduction</h2>
                        <p>If you are considering introducing SlowTH, please contact us. Our team will explain the details and propose a suitable plan.</p>
                        <a class="btn" href="https://jp-factory.co.jp/en/%e3%81%8a%e5%95%8f%e3%81%84%e5%90%88%e3%82%8f%e3%81%9b-en/">Contact Form</a>
                    </section>

                    <section id="video-extra" class="section section-alt">
                        <h2>Additional Test Videos</h2>
                        <p>These videos show assembly and tuning scenes during development.</p>
                        <div class="video-grid">
                            <div class="video-wrapper">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/A-43awT59-I" title="SlowTH test video 1" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/9aWWcD6gM1M" title="SlowTH test video 2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/sNJ4ahaqU5M" title="SlowTH test video 3" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/AIvJ21tAozk" title="SlowTH test video 4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="video-wrapper">
                                <iframe loading="lazy" width="100%" height="315" src="https://www.youtube.com/embed/HLrjQKxSLCc" title="SlowTH test video 5" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();