<h1>Auth With FB</h1>
<html>
    <body>
        <form action="{$smarty.get.redirect_uri}" method="get">
            <select name="auth_result">
                <option value="FlZ01X4JNLVjuQ4Umt1rvcOM45ilLm2efMkMCyNfqOw.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzNDIwMjI0MDAsImlzc3VlZF9hdCI6MTM0MjAxNjYxOCwib2F1dGhfdG9rZW4iOiJteV9mYWtlX2F1dGhlZF90b2tlbiIsInBhZ2UiOnsiaWQiOiI0MjM3NTY1MDEwMDExMzYiLCJsaWtlZCI6ZmFsc2UsImFkbWluIjp0cnVlfSwidXNlciI6eyJjb3VudHJ5IjoiZ2IiLCJsb2NhbGUiOiJlbl9VUyIsImFnZSI6eyJtaW4iOjIxfX0sInVzZXJfaWQiOiI1MTA4NDI2MDUifQ">
                    Test User
                </option>
                <option value="0rxnxFrg2Zgvxz5d3qgLX8vuMnAadCPfCVFQQebCxjw.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzNDIwMjI0MDAsImlzc3VlZF9hdCI6MTM0MjAxNjYxOCwib2F1dGhfdG9rZW4iOiJleGNlcHRpb25fdG9rZW4iLCJwYWdlIjp7ImlkIjoiNDIzNzU2NTAxMDAxMTM2IiwibGlrZWQiOmZhbHNlLCJhZG1pbiI6dHJ1ZX0sInVzZXIiOnsiY291bnRyeSI6ImdiIiwibG9jYWxlIjoiZW5fVVMiLCJhZ2UiOnsibWluIjoyMX19LCJ1c2VyX2lkIjoiNTEwODQyNjA1In0">
                    Trigger exception from FB graph
                </option>
                <option value="OOUZdmegyyXW2mQm1AZD8b9KuGwdrTRpNHC03Diqf84.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImV4cGlyZXMiOjEzNDIwMjI0MDAsInBhZ2UiOnsiaWQiOiI0MjM3NTY1MDEwMDExMzYiLCJsaWtlZCI6ZmFsc2UsImFkbWluIjp0cnVlfSwidXNlciI6eyJjb3VudHJ5IjoiZ2IiLCJsb2NhbGUiOiJlbl9VUyIsImFnZSI6eyJtaW4iOjIxfX19">
                    Not Authed
                </option>
            </select>

            <input type="submit" />

        </form>

        <a href="">Reject app</a>
    </body>
</html>
