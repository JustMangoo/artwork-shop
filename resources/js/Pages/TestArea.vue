<template>
    <div>
        <!-- you can put some webfonts here if you want -->
        <link
            href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700"
            rel="stylesheet"
            type="text/css"
        />

        <!-- change the HEX values here -->
        <div class="sectionHeading">
            <span class="sectionTitle">COLORS</span>
            <div class="sectionSeperator"></div>
        </div>

        <ul id="colors">
            <li class="colorCircle color-1">
                <div class="colorHex">--light</div>
            </li>
            <li class="colorCircle color-2">
                <div class="colorHex">--dark</div>
            </li>
            <li class="colorCircle color-3">
                <div class="colorHex">--primary</div>
            </li>
            <li class="colorCircle color-4">
                <div class="colorHex">--secondary</div>
            </li>
            <li class="colorCircle color-5">
                <div class="colorHex">--white</div>
            </li>
        </ul>

        <!-- customize these heading descriptions if necessary -->
        <div class="sectionHeading">
            <span class="sectionTitle">TYPOGRAPHY</span>
            <div class="sectionSeperator"></div>
        </div>

        <div id="typography">
            <h1>H1. Header 1. šŠāĀ</h1>
            <h2>H2. Header 2. šŠāĀ</h2>
            <h3>H3. Header 3. šŠāĀ</h3>
            <h4>H4. Header 4. šŠāĀ</h4>
            <h5>H5. Header 5. šŠāĀ</h5>
            <p>A general paragraph will look like this.</p>
        </div>

        <!-- use these as needed -->
        <div class="sectionHeading">
            <span class="sectionTitle">INLINE ELEMENTS</span>
            <div class="sectionSeperator"></div>
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

        <div class="sectionHeading">
            <span class="sectionTitle">FORM ELEMENTS</span>
            <div class="sectionSeperator"></div>
        </div>

        <div id="formElements">
            <form>
                <div class="form-item">
                    <label for="text">Email</label>
                    <input
                        type="text"
                        placeholder="Text Field"
                        name="text"
                        id="text"
                    />
                </div>
                <div class="form-item">
                    <input
                        type="password"
                        placeholder="Password"
                        name=""
                        id="password"
                    />
                </div>
                <div class="form-item">
                    <input
                        type="email"
                        placeholder="Email"
                        name="email"
                        id="email"
                    />
                </div>
                <div class="form-item">
                    <input
                        type="tel"
                        placeholder="Phone Number"
                        name=""
                        id="email"
                    />
                </div>
                <div class="form-item">
                    <input
                        type="number"
                        placeholder="Number"
                        name=""
                        id="number"
                    />
                </div>
                <div class="form-item">
                    <input type="date" name="" id="date" />
                </div>
                <div class="form-item">
                    <textarea
                        name=""
                        id="textarea"
                        cols="40"
                        rows="5"
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
                        <input type="radio" name="example-radios" id="" /><label
                            for=""
                            class="option"
                            >Radio Two</label
                        >
                    </div>
                </div>

                <div class="form-item form-type-checkboxes">
                    <div class="form-item">
                        <input type="checkbox" name="" id="" /><label for=""
                            >checkbox 1</label
                        >
                    </div>
                    <div class="form-item">
                        <input type="checkbox" name="" id="" /><label for=""
                            >checkbox 2</label
                        >
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="form-submit">Cancel</button>
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-submit">Submit</button>
                </div>
            </form>
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
    background: var(--light);
}
.color-2 {
    background: var(--dark);
}
.color-3 {
    background: var(--primary);
}
.color-4 {
    background: var(--secondary);
}
.color-5 {
    background: var(--white);
    border: 1px solid lightgrey;
}

/* General Styles */
html {
    background: #f7f7f7;
}

#templateTitle,
ul#colors,
#typography,
#inlineElements,
#formElements {
    width: 90%; /* Increased width to fit more elements */
    margin: 0 auto 2rem auto; /* Consistent vertical spacing */
}

/* Section Headings */
.sectionHeading {
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    font-family: sans-serif;
}
.sectionTitle {
    font-size: 1.2rem;
    font-weight: 500; /* Slightly bolder title */
    color: #848484;
    margin-right: 1rem;
}
.sectionSeperator {
    flex-grow: 1;
    height: 1px;
    background-color: #cccccc;
}

/* Project Title and Description */
#templateTitle {
    text-align: center; /* Center title and description */
}
#projectTitle {
    font-size: 2.5rem;
    font-weight: 700;
    color: #c4c4c4;
}
#projectDesc {
    font-size: 1rem;
    font-weight: 300;
    color: #dbdbdb;
}

#colors {
    display: flex;
}

/* Color Circles */
.colorCircle {
    width: 60px; /* Smaller circles */
    height: 60px;
    border-radius: 50%;
    display: flex; /* Allow better vertical alignment */
    align-items: center; /* Center hex code vertically */
    justify-content: center; /* Center hex code horizontally */
    margin-right: 10px; /* Reduced spacing */
}

li {
    display: flex; /* Allow better vertical alignment */
}
.colorHex {
    color: var(--dark);
}

/* Form Elements */
#formElements {
    form {
        display: grid;
        grid-template-columns: repeat(
            auto-fit,
            minmax(200px, 1fr)
        ); /* Responsive columns */
        gap: 1rem;

        .form-item {
            margin-bottom: 0.5rem;
        }
    }
}
</style>
