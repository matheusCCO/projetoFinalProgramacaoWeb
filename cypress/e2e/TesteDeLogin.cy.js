describe("Teste na tela de login", () => {
  beforeEach(() => {
    cy.visit("http://localhost/projetoFinalProgramacaoWeb/login.php");
  });
  it("Teste com loguin invalido", () => {
    cy.get('[type="email"]').type("teste@teste.com");
    cy.get('[type="password"]').type("12");
    cy.get('[type="submit"]').click();
    cy.contains("E-mail ou senha não encontrados").should("be.visible");
  });

  it("Teste com loguin invalido", () => {
    cy.get('[type="email"]').type("teste@teste.com");
    cy.get('[type="password"]').type("123");
    cy.get('[type="submit"]').click();
  });

  it("Teste com login, peenchendo um so campo", () => {
    cy.get('[type="email"]').type("teste@teste.com");
    cy.get('[type="submit"]').click();
    cy.contains("E-mail ou senha incorretos!").should("be.visible");
  });
});
