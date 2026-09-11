<?php
/**
 * JPF Global English site — overseas sales / RFQ landing page.
 *
 * Everything on this page is scoped under .jpf-en-home (see style.css) so it
 * does not lean on the Japanese top page's body.page-id-3435 design system —
 * future changes to the JP top page cannot break this page's layout.
 *
 * Real photos/equipment names/material list/process descriptions only —
 * nothing here states a tolerance, lead time, certification, inspection
 * report, carrier name, capacity figure, or client count that isn't already
 * published on the JP site.
 */

get_header();

$rfq_form_id = 3566;
?>
<main id="content" class="neve-main">
    <div class="container single-page-container">
        <div class="row">
            <div class="nv-single-page-wrap col">
                <div class="nv-content-wrap entry-content">
                    <div class="jpf-en-home">

                    <section id="hero" class="jpf-en-hero jpf-en-reveal">
                        <p class="jpf-en-hero__kicker">CNC Machining &amp; Wire EDM · Made in Kyoto, Japan</p>
                        <h1>Precision Machined Parts<br>from Japan</h1>
                        <p class="jpf-en-hero__copy">CNC Machining &amp; Wire EDM for prototype, low-volume, and high-mix production. Worldwide shipping — international orders welcome.</p>
                        <div class="jpf-en-hero__actions">
                            <a class="jpf-en-btn jpf-en-btn--primary" href="#quote" data-gtm-event="en_rfq_click">UPLOAD DRAWING &amp; GET A QUOTE</a>
                            <a class="jpf-en-btn jpf-en-btn--ghost" href="#examples" data-gtm-event="en_examples_click">See Machining Examples</a>
                        </div>
                    </section>

                    <nav class="jpf-en-quicknav jpf-en-reveal" aria-label="Page navigation">
                        <a href="#capabilities">Capabilities</a>
                        <a href="#examples">Machining Examples</a>
                        <a href="#materials">Materials</a>
                        <a href="#equipment">Equipment</a>
                        <a href="#quality">Quality</a>
                        <a href="#company">Company</a>
                        <a href="#quote">Request a Quote</a>
                    </nav>

                    <section id="capabilities" class="jpf-en-section jpf-en-reveal">
                        <h2>Machining Capabilities</h2>
                        <p class="jpf-en-section__lead">JPF combines CNC machining and wire EDM in-house, so we can machine functional features and precision contours on the same part without outsourcing between processes.</p>
                        <div class="jpf-en-capability-grid">
                            <div class="jpf-en-capability-card">
                                <h3>CNC Machining</h3>
                                <p>Milling for holes, pockets, contours, and 3D shapes.</p>
                            </div>
                            <div class="jpf-en-capability-card">
                                <h3>Wire EDM</h3>
                                <p>Non-contact wire cutting for hardened steel and narrow/complex contours.</p>
                            </div>
                            <div class="jpf-en-capability-card">
                                <h3>Machining + Wire EDM Combination</h3>
                                <p>One part machined with both processes in-house, where the design calls for it.</p>
                            </div>
                            <div class="jpf-en-capability-card">
                                <h3>Complex &amp; Multi-Face Parts</h3>
                                <p>Multi-face machining for parts that need several setups.</p>
                            </div>
                            <div class="jpf-en-capability-card">
                                <h3>Prototype (1 piece)</h3>
                                <p>Single-piece prototype machining.</p>
                            </div>
                            <div class="jpf-en-capability-card">
                                <h3>Low-Volume Production</h3>
                                <p>Small-lot production runs.</p>
                            </div>
                            <div class="jpf-en-capability-card">
                                <h3>High-Mix Production</h3>
                                <p>Many different part numbers, switched efficiently on the same equipment.</p>
                            </div>
                        </div>
                        <div class="jpf-en-photo-duo">
                            <figure>
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/robodrill-kakouchu.jpg" alt="CNC machining in progress at JPF" loading="lazy" width="700" height="525">
                                <figcaption>CNC machining in progress</figcaption>
                            </figure>
                            <figure>
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/wire-kakouchu.jpg" alt="Wire EDM machining in progress at JPF" loading="lazy" width="700" height="525">
                                <figcaption>Wire EDM machining in progress</figcaption>
                            </figure>
                        </div>
                    </section>

                    <section id="examples" class="jpf-en-section jpf-en-section--alt jpf-en-reveal">
                        <h2>Machining Examples</h2>
                        <p class="jpf-en-section__lead">A selection of parts we have actually machined. Photos only — no pricing shown here.</p>
                        <div class="jpf-en-gallery-grid">
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_a5052_1s.jpg" alt="Machined part, A5052 aluminum, machining and wire EDM" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: A5052</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: Machining + Wire EDM</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_sus304_1s.jpg" alt="Machined part, SUS304 stainless steel" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: SUS304</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: CNC Machining</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/ryosan_skd11_1s.jpg" alt="Machined part, SKD11 hardened tool steel, wire EDM" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: SKD11 (HRC58)</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: Wire EDM</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/ryosan_a7075_1s.jpg" alt="Machined part, A7075 aluminum, machining and wire EDM" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: A7075</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: Machining + Wire EDM</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_hap40_1s.jpg" alt="Machined part, HAP40 hardened tool steel, wire EDM" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: HAP40 (HRC64)</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: Wire EDM</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_sus316_1s.jpg" alt="Machined part, SUS316 stainless steel" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: SUS316</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: CNC Machining</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/buhin_a6063_1s.jpg" alt="Machined part, A6063 aluminum" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: A6063</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: CNC Machining</span>
                                </div>
                            </div>
                            <div class="jpf-en-gallery-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/ryosan_s55c_1s.jpg" alt="Machined part, S55C carbon steel" loading="lazy" width="600" height="450">
                                <div class="jpf-en-gallery-card__body">
                                    <span class="jpf-en-tag">Material: S55C</span>
                                    <span class="jpf-en-tag jpf-en-tag--accent">Process: CNC Machining</span>
                                </div>
                            </div>
                        </div>
                        <div class="jpf-en-section-cta">
                            <a class="jpf-en-btn jpf-en-btn--outline" href="https://jp-factory.co.jp/content/" target="_blank" rel="noopener noreferrer" data-gtm-event="en_more_examples_click">See More Examples</a>
                            <a class="jpf-en-btn jpf-en-btn--primary" href="#quote" data-gtm-event="en_rfq_click">UPLOAD DRAWING &amp; GET A QUOTE</a>
                        </div>
                    </section>

                    <section id="why-jpf" class="jpf-en-section jpf-en-reveal">
                        <h2>Why JPF</h2>
                        <ul class="jpf-en-why-list">
                            <li>
                                <h3>Made in Kyoto, Japan</h3>
                                <p>Precision machining produced at our own factory in Kyoto.</p>
                            </li>
                            <li>
                                <h3>CNC Machining + Wire EDM, In-House</h3>
                                <p>Both processes under one roof, so we can choose the right method — or combine them — for each part.</p>
                            </li>
                            <li>
                                <h3>Prototype &amp; Low-Volume Production</h3>
                                <p>From a single prototype to low-volume and high-mix production runs.</p>
                            </li>
                            <li>
                                <h3>Direct Communication with the Manufacturer</h3>
                                <p>Your drawing is reviewed directly by our engineering team.</p>
                            </li>
                            <li>
                                <h3>Inspection Before Shipment</h3>
                                <p>Parts are checked using our measuring equipment before they ship.</p>
                            </li>
                            <li>
                                <h3>International Shipping Available</h3>
                                <p>We accept and ship orders to customers outside Japan.</p>
                            </li>
                        </ul>
                    </section>

                    <section id="materials" class="jpf-en-section jpf-en-section--alt jpf-en-reveal">
                        <h2>Materials</h2>
                        <p class="jpf-en-section__lead">Materials we have machining experience with. Other materials — please ask.</p>
                        <ul class="jpf-en-material-list">
                            <li class="jpf-en-tag">Aluminum</li>
                            <li class="jpf-en-tag">Stainless Steel</li>
                            <li class="jpf-en-tag">Steel</li>
                            <li class="jpf-en-tag">Pre-Hardened Steel</li>
                            <li class="jpf-en-tag">Titanium</li>
                            <li class="jpf-en-tag">Inconel</li>
                            <li class="jpf-en-tag jpf-en-tag--accent">Other materials — please ask</li>
                        </ul>
                    </section>

                    <section id="equipment" class="jpf-en-section jpf-en-reveal">
                        <h2>Equipment</h2>
                        <p class="jpf-en-section__lead">Our main machining equipment.</p>
                        <div class="jpf-en-equipment-grid">
                            <div class="jpf-en-equipment-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_robo.jpg" alt="FANUC ROBODRILL at JPF" loading="lazy" width="600" height="450">
                                <h3>FANUC ROBODRILL</h3>
                                <p>High-speed, high-precision CNC machining.</p>
                            </div>
                            <div class="jpf-en-equipment-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2022/12/factory_mc.jpg" alt="Machining center at JPF" loading="lazy" width="600" height="450">
                                <h3>Machining Center</h3>
                                <p>Multi-face, precision machining.</p>
                            </div>
                            <div class="jpf-en-equipment-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_cut.jpg" alt="Wire EDM machine at JPF" loading="lazy" width="600" height="450">
                                <h3>Wire EDM Machine</h3>
                                <p>High-precision wire EDM cutting.</p>
                            </div>
                            <div class="jpf-en-equipment-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/03/factory_ncen.jpg" alt="Rotary table at JPF" loading="lazy" width="600" height="450">
                                <h3>Rotary Table</h3>
                                <p>Multi-face and indexed machining.</p>
                            </div>
                            <div class="jpf-en-equipment-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/factory_automation.jpg" alt="Automation system at JPF" loading="lazy" width="600" height="450">
                                <h3>Automation System</h3>
                                <p>Stable quality and productivity.</p>
                            </div>
                            <div class="jpf-en-equipment-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/factory_measure.jpg" alt="Measuring equipment at JPF" loading="lazy" width="600" height="450">
                                <h3>Measuring Equipment</h3>
                                <p>CMM and other measuring instruments.</p>
                            </div>
                        </div>
                    </section>

                    <section id="quality" class="jpf-en-section jpf-en-section--alt jpf-en-reveal">
                        <h2>Quality / Inspection</h2>
                        <p class="jpf-en-section__lead">Inspection before shipment, using our own measuring equipment and process records.</p>
                        <div class="jpf-en-quality-grid">
                            <div class="jpf-en-quality-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_postinspection.jpg" alt="Post-machining inspection at JPF" loading="lazy" width="500" height="375">
                                <h3>Post-Machining Inspection</h3>
                                <p>Dimensions checked after or during machining.</p>
                            </div>
                            <div class="jpf-en-quality-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_dimension.jpg" alt="Dimensional control at JPF" loading="lazy" width="500" height="375">
                                <h3>Dimensional Control</h3>
                                <p>Measurement data used to keep quality stable.</p>
                            </div>
                            <div class="jpf-en-quality-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2024/04/factory_soft.jpg" alt="Drawing and data management at JPF" loading="lazy" width="500" height="375">
                                <h3>Drawing &amp; Data Management</h3>
                                <p>Drawings and machining data are managed carefully.</p>
                            </div>
                            <div class="jpf-en-quality-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_traceability.jpg" alt="Traceability management at JPF" loading="lazy" width="500" height="375">
                                <h3>Traceability</h3>
                                <p>Production records are kept as needed.</p>
                            </div>
                            <div class="jpf-en-quality-card">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/quality_shipping.jpg" alt="Pre-shipment check at JPF" loading="lazy" width="500" height="375">
                                <h3>Pre-Shipment Check</h3>
                                <p>A final check is done before parts ship.</p>
                            </div>
                        </div>
                    </section>

                    <section id="how-to-order" class="jpf-en-section jpf-en-reveal">
                        <h2>How to Order</h2>
                        <p class="jpf-en-section__lead">Ordering from outside Japan, step by step.</p>
                        <div class="jpf-en-steps-grid">
                            <div class="jpf-en-step">
                                <span class="jpf-en-step__num">STEP 1</span>
                                <h3>Upload Your Drawing</h3>
                                <p>Send your drawing (PDF, STEP, DXF, etc.) through the RFQ form.</p>
                            </div>
                            <div class="jpf-en-step">
                                <span class="jpf-en-step__num">STEP 2</span>
                                <h3>Receive a Quotation</h3>
                                <p>JPF reviews your drawing and sends a quotation.</p>
                            </div>
                            <div class="jpf-en-step">
                                <span class="jpf-en-step__num">STEP 3</span>
                                <h3>Confirm the Quote &amp; Payment</h3>
                                <p>Confirm the quotation and complete payment in advance.</p>
                            </div>
                            <div class="jpf-en-step">
                                <span class="jpf-en-step__num">STEP 4</span>
                                <h3>Manufacturing</h3>
                                <p>JPF manufactures your parts.</p>
                            </div>
                            <div class="jpf-en-step">
                                <span class="jpf-en-step__num">STEP 5</span>
                                <h3>Inspection</h3>
                                <p>Parts are inspected before shipment.</p>
                            </div>
                            <div class="jpf-en-step">
                                <span class="jpf-en-step__num">STEP 6</span>
                                <h3>International Shipping</h3>
                                <p>Your order ships internationally.</p>
                            </div>
                        </div>
                        <div class="jpf-en-section-cta">
                            <a class="jpf-en-btn jpf-en-btn--primary" href="#quote" data-gtm-event="en_rfq_click">UPLOAD DRAWING &amp; GET A QUOTE</a>
                        </div>
                    </section>

                    <section id="international" class="jpf-en-section jpf-en-section--alt jpf-en-reveal">
                        <h2>International Orders</h2>
                        <ul class="jpf-en-intl-list">
                            <li>We accept inquiries from customers worldwide.</li>
                            <li>New international customers are generally requested to make payment in advance.</li>
                            <li>International shipping is available via major international carriers.</li>
                            <li>Import duties, taxes, and customs clearance fees are generally the responsibility of the buyer, unless otherwise agreed.</li>
                        </ul>
                    </section>

                    <section id="company" class="jpf-en-section jpf-en-reveal">
                        <h2>Company</h2>
                        <div class="jpf-en-company-grid">
                            <div class="jpf-en-company-photo">
                                <img src="https://jp-factory.co.jp/wp-content/uploads/2026/08/company_exterior.jpg" alt="JPF factory exterior, Kyoto, Japan" loading="lazy" width="700" height="525">
                            </div>
                            <div class="jpf-en-company-info">
                                <p><strong>J.P.F Co., Ltd.</strong></p>
                                <p>206 To-no-Mori Shibahigashi-cho, Kamitoba, Minami-ku, Kyoto 601-8162, Japan</p>
                                <p>TEL: +81-75-600-2886 / FAX: +81-75-203-7819</p>
                                <div class="jpf-en-company-links">
                                    <a href="https://jp-factory.co.jp/en/%e4%bc%9a%e7%a4%be%e6%a6%82%e8%a6%81-en/" target="_blank" rel="noopener noreferrer">Profile</a>
                                    <a href="https://jp-factory.co.jp/en/%e6%a5%ad%e5%8b%99%e5%86%85%e5%ae%b9-en/" target="_blank" rel="noopener noreferrer">Content</a>
                                    <a href="https://jp-factory.co.jp/en/factory-introduction/" target="_blank" rel="noopener noreferrer">Factory</a>
                                    <a href="https://jp-factory.co.jp/en/slowth/" target="_blank" rel="noopener noreferrer">Automation Solutions (SlowTH)</a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="quote" class="jpf-en-quote-band jpf-en-reveal">
                        <h2>Have a Drawing?<br>Send It to JPF.</h2>
                        <p class="jpf-en-quote-band__lead">Upload your drawing and our engineering team in Kyoto will review it and send you a quotation.</p>
                        <div class="jpf-en-quote-form">
                            <?php
                            // Render via the plugin's own form-embed block (not the raw
                            // post_content of the form CPT): this is the same mechanism
                            // page 3474 uses for the JP quote form (3473) — it wraps the
                            // output in the actual <form class="snow-monkey-form" ...>
                            // element with working <input>/<select>/<textarea> controls,
                            // the confirm/complete screen JS, and CSRF nonce. Calling
                            // do_blocks() directly on the form CPT's own post_content (the
                            // control-* blocks) renders only their static label markup with
                            // no real form controls, since those blocks are designed to be
                            // rendered *inside* this embed block, not standalone.
                            echo do_blocks( '<!-- wp:snow-monkey-forms/snow-monkey-form {"formId":' . (int) $rfq_form_id . '} /-->' );
                            ?>
                        </div>
                        <?php /* Privacy Policy link intentionally omitted: page ID 3 (privacy-policy) is currently unpublished (draft) — see report. */ ?>
                    </section>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
