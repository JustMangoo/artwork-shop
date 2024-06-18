<template>
    <div>
        <!-- you can put some webfonts here if you want -->
        <link
            href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700"
            rel="stylesheet"
            type="text/css"
        />

        <div class="section-heading">
            <span>colors</span>
            <div></div>
        </div>

        <ul id="colors">
            <li class="color-block color-1">--color--light</li>
            <li class="color-block color-2">--color--dark</li>
            <li class="color-block color-3">--color--primary</li>
            <li class="color-block color-4">--color--secondary</li>
        </ul>
        <ul id="colors">
            <li class="color-block color-5">--color--info</li>
            <li class="color-block color-6">--color--success</li>
            <li class="color-block color-7">--color--warning</li>
            <li class="color-block color-8">--color--error</li>
        </ul>

        <div class="section-heading">
            <span>TYPOGRAPHY</span>
            <div></div>
        </div>

        <div id="typography">
            <h1>H1. Header 1. šŠāĀ</h1>
            <h2>H2. Header 2. šŠāĀ</h2>
            <h3>H3. Header 3. šŠāĀ</h3>
            <h4>H4. Header 4. šŠāĀ</h4>
            <h5>H5. Header 5. šŠāĀ</h5>
            <p>A general paragraph will look like this.</p>
        </div>

        <div class="section-heading">
            <span>Inline Elements</span>
            <div></div>
        </div>

        <div id="inlineElements">
            <p><a href="#">This is a text link</a></p>
            <p><strong>Strong is used to indicate strong importance</strong></p>

            <p>
                The <b>b element</b> is stylistically different text from normal
                text, without any special importance
            </p>

            <p>
                The <em>i element</em> is text that is set off from the normal
                text
            </p>

            <p>
                The <u>u element</u> is text with an unarticulated, though
                explicitly rendered, non-textual annotation
            </p>

            <p>
                <small>This small text is small for for fine print, etc.</small>
            </p>

            <p>
                <q
                    cite="https://developer.mozilla.org/en-US/docs/HTML/Element/q"
                    >This text is a short inline quotation</q
                >
            </p>

            <p><cite>This is a citation</cite></p>
        </div>

        <div class="section-heading">
            <span>Form Elements</span>
            <div></div>
        </div>

        <div id="formElements">
            <form>
                <div class="form-item">
                    <label for="text">Name</label>
                    <input
                        type="text"
                        placeholder="Text Field"
                        name="text"
                        id="text"
                    />
                </div>
                <div class="form-item">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        placeholder="Password"
                        name="password"
                        id="password"
                    />
                </div>
                <div class="form-item">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        placeholder="Email"
                        name="email"
                        id="email"
                    />
                </div>
                <div class="form-item">
                    <label for="tel">Phone Nr.</label>
                    <input
                        type="tel"
                        placeholder="Phone Number"
                        name="tel"
                        id="tel"
                    />
                </div>
                <div class="form-item">
                    <label for="number">Number</label>
                    <input
                        type="number"
                        placeholder="Number"
                        name="number"
                        id="number"
                    />
                </div>
                <div class="form-item">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" />
                </div>
                <div class="form-item">
                    <textarea
                        name=""
                        id="textarea"
                        cols="40"
                        rows="3"
                        placeholder="Textarea"
                    ></textarea>
                </div>
                <div class="form-item">
                    <select name="" id="select">
                        <option value="default">-- Select --</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                        <option value="">Option 3</option>
                    </select>
                </div>

                <div class="form-item form-type-radios">
                    <div class="form-item">
                        <input
                            type="radio"
                            name="example-radios"
                            id="radio"
                        /><label for="" class="option">Radio One</label>
                    </div>
                    <div class="form-item">
                        <input type="radio" name="example-radios" /><label
                            for=""
                            class="option"
                            >Radio Two</label
                        >
                    </div>
                </div>

                <div class="form-item form-type-checkboxes">
                    <div class="form-item">
                        <input type="checkbox" name="" /><label for=""
                            >checkbox 1</label
                        >
                    </div>
                    <div class="form-item">
                        <input type="checkbox" name="" /><label for=""
                            >checkbox 2</label
                        >
                    </div>
                </div>

                <div class="form-actions">
                    <button>Default</button>
                    <button disabled>Disabled</button>
                </div>

                <div class="form-actions">
                    <button class="btn-primary">Primary</button>
                    <button class="btn-secondary">Secondary</button>
                </div>
            </form>
        </div>

        <div class="section-heading">
            <span>Tables</span>
            <div></div>
        </div>

        <div class="table-container">
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Nosaukums</th>
                        <th>raksts</th>
                        <th>Cena</th>
                        <th>kategorija</th>
                        <th>Bilde</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>A long description about something</td>
                        <td>99.99&euro;</td>
                        <td>
                            <div class="table-badge">Tag</div>
                        </td>
                        <td>
                            <div class="image-cell">
                                <img
                                    src="@\Assets\Images\foto1.webp"
                                    alt="Product Image"
                                    class="table-image"
                                />
                            </div>
                        </td>
                        <td>
                            <img
                                class="action-btn"
                                src="@/Assets/pen.svg"
                                alt="edit-icon"
                            />
                            <img
                                class="action-btn"
                                src="@/Assets/trash.svg"
                                alt="delete-icon"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    setup() {
        return {};
    },
};
</script>

<style lang="scss" scoped>
/* Color Variables */
.color-1 {
    background: var(--color--light);
    color: var(--color--dark);
}
.color-2 {
    background: var(--color--dark);
    color: var(--color--light);
}
.color-3 {
    background: var(--color--primary);
    color: var(--color--light);
}
.color-4 {
    background: var(--color--secondary);
    color: var(--color--dark);
}
.color-5 {
    background: var(--color--info);
    color: var(--color--dark);
}
.color-6 {
    background: var(--color--success);
    color: var(--color--dark);
}
.color-7 {
    background: var(--color--warning);
    color: var(--color--dark);
}
.color-8 {
    background: var(--color--error);
    color: var(--color--dark);
}

/* General Styles */
html {
    background: var(--color--white);
}

#templateTitle,
ul#colors,
#typography,
#inlineElements,
#formElements,
.table-container {
    width: 95%; /* Increased width to fit more elements */
    margin: 0 auto 32px auto; /* Consistent vertical spacing */
}

/* Section Headings */
.section-heading {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    text-transform: uppercase;

    span {
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--color--dark);
        margin-right: 8px;
    }

    div {
        flex-grow: 1;
        height: 1px;
        background-color: var(--color--dark);
    }
}

/* Color Circles */
#colors {
    display: flex;
}
.color-block {
    width: 100%;
    height: 60px;
    border-radius: var(--rounded-elem);
    display: flex; /* Allow better vertical alignment */
    align-items: center; /* Center hex code vertically */
    justify-content: center; /* Center hex code horizontally */
    margin-right: 10px; /* Reduced spacing */
}

li {
    display: flex; /* Allow better vertical alignment */
}

/* Form Elements */
#formElements {
    form {
        display: grid;
        grid-template-columns: repeat(
            auto-fit,
            minmax(200px, 1fr)
        ); /* Responsive columns */
        justify-items: center;
        align-items: center;
        gap: 1rem;

        .form-item {
            margin-bottom: 0.5rem;
        }
        .form-actions {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px;
            button {
                width: 100%;
            }
        }
    }
}
</style>
